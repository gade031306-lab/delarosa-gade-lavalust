<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        $_SESSION['student_access'] = true;

        $this->call->view('student/index');
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC-2024-00073',
            'name' => 'Gade Dela Rosa',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3F2',
            'email' => 'gade.031306@gmail.com'
        ];

        $this->call->view('student/profile', $student);
    }
}