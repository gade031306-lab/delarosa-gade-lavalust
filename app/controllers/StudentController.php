<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load database
        $this->call->database();

        // Load Users Model
        $this->call->model('UsersModel');
    }


    // ============================================================
    // STUDENT HOME
    // ============================================================

    public function index()
    {
        redirect('student/profile');
    }


    // ============================================================
    // STUDENT DASHBOARD / PROFILE
    // ============================================================

    public function profile()
    {
        $user_id = $_SESSION['user_id'];

        $query = $this->UsersModel->raw(
            "SELECT id, firstname, lastname, email, username
             FROM users
             WHERE id = ?
             LIMIT 1",
            [$user_id]
        );

        $student = $query->fetch(PDO::FETCH_OBJ);


        // User no longer exists
        if (!$student) {

            $_SESSION = [];

            session_destroy();

            redirect('login');

            exit;
        }


        $data['student'] = $student;


        $this->call->view(
            'student/profile',
            $data
        );
    }
}