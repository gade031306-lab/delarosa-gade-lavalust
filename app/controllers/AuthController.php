<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load database
        $this->call->database();

        // Load Users Model
        $this->call->model('UsersModel');

        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    // ==========================================
    // LOGIN PAGE
    // ==========================================
    public function login()
    {
        // If already logged in,
        // Dashboard becomes the home page
        if (isset($_SESSION['user_id'])) {
            redirect('student/profile');
            return;
        }

        $this->call->view('auth/login');
    }


    // ==========================================
    // LOGIN PROCESS
    // ==========================================
    public function authenticate()
    {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Find user by username
        $query = $this->UsersModel->raw(
            "SELECT * FROM users WHERE username = ? LIMIT 1",
            [$username]
        );

        // Get user record
        $user = $query->fetch(PDO::FETCH_OBJ);

        // User does not exist
        if (!$user) {

            $_SESSION['login_error'] =
                'Invalid username or password.';

            redirect('login');
            return;
        }


        // ==========================================
        // CHECK PASSWORD
        // ==========================================

        $valid = false;


        // Check secure hashed password
        if (password_verify($password, $user->password)) {

            $valid = true;

        }


        // ==========================================
        // SUPPORT OLD PLAIN-TEXT PASSWORD
        // ==========================================

        elseif ($user->password === $password) {

            // Convert old password into secure hash
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Save hashed password
            $this->UsersModel->update(
                $user->id,
                [
                    'password' => $hashed_password
                ]
            );

            $valid = true;
        }


        // ==========================================
        // INVALID PASSWORD
        // ==========================================

        if (!$valid) {

            $_SESSION['login_error'] =
                'Invalid username or password.';

            redirect('login');
            return;
        }


        // ==========================================
        // CREATE LOGIN SESSION
        // ==========================================

        $_SESSION['user_id'] =
            $user->id;

        $_SESSION['username'] =
            $user->username;

        $_SESSION['firstname'] =
            $user->firstname;

        $_SESSION['lastname'] =
            $user->lastname;


        // ==========================================
        // LOGIN SUCCESS
        // DASHBOARD IS HOME PAGE
        // ==========================================

        redirect('student/profile');
    }


    // ==========================================
    // REGISTER PAGE
    // ==========================================
    public function register()
    {
        // If already logged in
        if (isset($_SESSION['user_id'])) {

            redirect('student/profile');
            return;
        }

        $this->call->view('auth/register');
    }


    // ==========================================
    // REGISTER PROCESS
    // ==========================================
    public function store()
    {
        $firstname =
            $this->io->post('firstname');

        $lastname =
            $this->io->post('lastname');

        $email =
            $this->io->post('email');

        $username =
            $this->io->post('username');

        $password =
            $this->io->post('password');

        $confirm_password =
            $this->io->post('confirm_password');


        // ==========================================
        // CHECK PASSWORD
        // ==========================================

        if ($password !== $confirm_password) {

            $_SESSION['register_error'] =
                'Passwords do not match.';

            redirect('register');
            return;
        }


        // ==========================================
        // CHECK USERNAME
        // ==========================================

        $query_username =
            $this->UsersModel->raw(
                "SELECT * FROM users WHERE username = ? LIMIT 1",
                [$username]
            );

        $existing_username =
            $query_username->fetch(PDO::FETCH_OBJ);


        if ($existing_username) {

            $_SESSION['register_error'] =
                'Username already exists.';

            redirect('register');
            return;
        }


        // ==========================================
        // CHECK EMAIL
        // ==========================================

        $query_email =
            $this->UsersModel->raw(
                "SELECT * FROM users WHERE email = ? LIMIT 1",
                [$email]
            );

        $existing_email =
            $query_email->fetch(PDO::FETCH_OBJ);


        if ($existing_email) {

            $_SESSION['register_error'] =
                'Email already exists.';

            redirect('register');
            return;
        }


        // ==========================================
        // HASH PASSWORD
        // ==========================================

        $hashed_password =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        // ==========================================
        // INSERT USER
        // ==========================================

        $data = [

            'firstname' =>
                $firstname,

            'lastname' =>
                $lastname,

            'email' =>
                $email,

            'username' =>
                $username,

            'password' =>
                $hashed_password
        ];


        $this->UsersModel->insert($data);


        // ==========================================
        // REGISTRATION SUCCESS
        // ==========================================

        $_SESSION['register_success'] =
            'Account created successfully. You can now login.';


        redirect('login');
    }


    // ==========================================
    // LOGOUT
    // ==========================================
    public function logout()
    {
        // Clear session
        $_SESSION = [];

        // Destroy session
        session_destroy();

        // Return to login
        redirect('login');
    }
}