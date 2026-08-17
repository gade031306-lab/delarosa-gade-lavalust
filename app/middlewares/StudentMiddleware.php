<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
        if (!isset($_SESSION['student_access'])) {
            $_SESSION['student_access'] = true;
        }

        if ($_SESSION['student_access'] === true) {
            return $next();
        }

        echo '<h1>Access Denied</h1>';
        echo '<p>You are not authorized to access the Student Profile.</p>';
        exit;
    }
}