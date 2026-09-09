<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('UsersModel');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // LOGIN PAGE
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            redirect('products');
            return;
        }

        $this->call->view('auth/login');
    }

    // LOGIN PROCESS
   // LOGIN PROCESS
public function authenticate()
{
    $username = $this->io->post('username');
    $password = $this->io->post('password');

    $query = $this->UsersModel->raw(
        "SELECT * FROM users WHERE username = ? LIMIT 1",
        [$username]
    );

    // Get the actual row from PDOStatement
    $user = $query->fetch(PDO::FETCH_OBJ);

    if (!$user) {
        $_SESSION['login_error'] = 'Invalid username or password.';
        redirect('login');
        return;
    }

    // Verify password
    if (!password_verify($password, $user->password)) {
        $_SESSION['login_error'] = 'Invalid username or password.';
        redirect('login');
        return;
    }

    // Store user information in session
    $_SESSION['user_id'] = $user->id;
    $_SESSION['username'] = $user->username;
    $_SESSION['firstname'] = $user->firstname;
    $_SESSION['lastname'] = $user->lastname;

    // Go to Product Management
    redirect('products');
}

    // REGISTER PAGE
    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            redirect('products');
            return;
        }

        $this->call->view('auth/register');
    }

    // REGISTER PROCESS
    public function store()
    {
        $firstname = $this->io->post('firstname');
        $lastname = $this->io->post('lastname');
        $email = $this->io->post('email');
        $username = $this->io->post('username');
        $password = $this->io->post('password');
        $confirm_password = $this->io->post('confirm_password');

        if ($password !== $confirm_password) {
            $_SESSION['register_error'] = 'Passwords do not match.';
            redirect('register');
            return;
        }

        // Check username
        $existing_username = $this->UsersModel->raw(
            "SELECT * FROM users WHERE username = ? LIMIT 1",
            [$username]
        );

        if ($existing_username) {
            $_SESSION['register_error'] = 'Username already exists.';
            redirect('register');
            return;
        }

        // Check email
        $existing_email = $this->UsersModel->raw(
            "SELECT * FROM users WHERE email = ? LIMIT 1",
            [$email]
        );

        if ($existing_email) {
            $_SESSION['register_error'] = 'Email already exists.';
            redirect('register');
            return;
        }

        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'username' => $username,
            'password' => $hashed_password
        ];

        $this->UsersModel->insert($data);

        $_SESSION['register_success'] =
            'Account created successfully. You can now login.';

        redirect('login');
    }

    // LOGOUT
    public function logout()
    {
        session_unset();
        session_destroy();

        redirect('login');
    }
}