<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // ==========================================
        // REQUIRE LOGIN
        // ==========================================

        if (!isset($_SESSION['user_id'])) {

            redirect('login');
            exit;
        }


        // Load database
        $this->call->database();

        // Load Users Model
        $this->call->model('UsersModel');
    }


    // ==========================================
    // STUDENT HOME
    // ==========================================
    public function index()
    {
        /*
         * The Dashboard is now the actual home page.
         *
         * Therefore /student redirects to
         * /student/profile.
         */

        redirect('student/profile');
    }


    // ==========================================
    // STUDENT PROFILE / DASHBOARD
    // ==========================================
    public function profile()
    {
        // Get currently logged-in user's ID
        $user_id = $_SESSION['user_id'];


        // ==========================================
        // GET USER FROM DATABASE
        // ==========================================

        $query = $this->UsersModel->raw(
            "SELECT id, firstname, lastname, email, username
             FROM users
             WHERE id = ?
             LIMIT 1",
            [$user_id]
        );


        // Convert database result to object
        $student = $query->fetch(PDO::FETCH_OBJ);


        // ==========================================
        // USER NO LONGER EXISTS
        // ==========================================

        if (!$student) {

            $_SESSION = [];

            session_destroy();

            redirect('login');
            exit;
        }


        // ==========================================
        // SEND STUDENT DATA TO VIEW
        // ==========================================

        $data['student'] = $student;


        // Load dashboard
        $this->call->view(
            'student/profile',
            $data
        );
    }
}