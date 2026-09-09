<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Dashboard - GadeLust
    </title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }


        /* ==========================================
           MOBILE HEADER
           ========================================== */

        .mobile-header {

            display: none;

            height: 60px;

            background: #1f2937;

            color: white;

            align-items: center;

            padding: 0 20px;

            position: fixed;

            top: 0;
            left: 0;
            right: 0;

            z-index: 1000;
        }


        .menu-btn {

            background: none;

            border: none;

            color: white;

            font-size: 25px;

            cursor: pointer;

            margin-right: 15px;
        }


        .mobile-title {

            font-size: 18px;

            font-weight: bold;
        }


        /* ==========================================
           SIDEBAR
           ========================================== */

        .sidebar {

            width: 240px;

            height: 100vh;

            background: #1f2937;

            color: white;

            position: fixed;

            left: 0;
            top: 0;

            padding: 25px 15px;

            z-index: 999;
        }


        .sidebar h2 {

            text-align: center;

            margin-bottom: 30px;

            font-size: 22px;
        }


        .sidebar a {

            display: block;

            color: white;

            text-decoration: none;

            padding: 13px 15px;

            margin-bottom: 6px;

            border-radius: 6px;

            transition: background 0.2s ease;
        }


        .sidebar a:hover {

            background: #374151;
        }


        .sidebar a.active {

            background: #2563eb;
        }


        /* ==========================================
           MAIN CONTENT
           ========================================== */

        .main {

            margin-left: 240px;

            padding: 40px;
        }


        .top-title {

            margin-bottom: 25px;
        }


        .top-title h1 {

            font-size: 30px;

            margin-bottom: 5px;
        }


        .top-title p {

            color: #666;
        }


        /* ==========================================
           PROFILE CARD
           ========================================== */

        .profile-card {

            background: white;

            border-radius: 12px;

            padding: 30px;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, 0.08);

            max-width: 850px;
        }


        .profile-header {

            display: flex;

            align-items: center;

            gap: 20px;

            margin-bottom: 30px;
        }


        .profile-icon {

            width: 75px;

            height: 75px;

            background: #2563eb;

            color: white;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 30px;

            font-weight: bold;

            flex-shrink: 0;
        }


        .profile-header h2 {

            font-size: 25px;

            margin-bottom: 5px;
        }


        .profile-header p {

            color: #777;
        }


        /* ==========================================
           WELCOME MESSAGE
           ========================================== */

        .welcome {

            background: #eff6ff;

            border: 1px solid #dbeafe;

            border-radius: 8px;

            padding: 18px;

            margin-bottom: 25px;
        }


        .welcome h3 {

            margin-bottom: 5px;

            color: #1d4ed8;
        }


        .welcome p {

            color: #555;

            line-height: 1.5;
        }


        /* ==========================================
           STUDENT INFORMATION
           ========================================== */

        .info-grid {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 20px;
        }


        .info-box {

            background: #f8fafc;

            padding: 18px;

            border-radius: 8px;

            border: 1px solid #e5e7eb;
        }


        .info-box label {

            display: block;

            font-size: 13px;

            color: #777;

            margin-bottom: 6px;
        }


        .info-box strong {

            font-size: 16px;

            color: #222;

            word-break: break-word;
        }


        /* ==========================================
           RESPONSIVE
           ========================================== */

        @media (max-width: 768px) {

            .mobile-header {

                display: flex;
            }


            .sidebar {

                transform:
                    translateX(-100%);

                transition:
                    transform 0.3s ease;

                top: 60px;

                height:
                    calc(100vh - 60px);
            }


            .sidebar.open {

                transform:
                    translateX(0);
            }


            .main {

                margin-left: 0;

                padding:
                    85px 20px 30px;
            }


            .top-title h1 {

                font-size: 25px;
            }


            .profile-card {

                padding: 20px;
            }


            .profile-header {

                align-items:
                    flex-start;
            }


            .profile-header h2 {

                font-size: 21px;
            }


            .info-grid {

                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 450px) {

            .profile-header {

                flex-direction: column;

                align-items: center;

                text-align: center;
            }


            .profile-icon {

                width: 65px;

                height: 65px;

                font-size: 25px;
            }


            .main {

                padding-left: 15px;

                padding-right: 15px;
            }

        }

    </style>

</head>


<body>


<!-- ==========================================
     MOBILE HEADER
     ========================================== -->

<div class="mobile-header">

    <button
        class="menu-btn"
        onclick="toggleMenu()">

        ☰

    </button>


    <div class="mobile-title">

        GadeLust

    </div>

</div>


<!-- ==========================================
     SIDEBAR
     ========================================== -->

<div
    class="sidebar"
    id="sidebar">


    <h2>
        GadeLust
    </h2>


    <!-- DASHBOARD / HOME -->

    <a
        href="<?= site_url('student/profile'); ?>"
        class="active">

        🏠 Dashboard

    </a>


    <!-- STUDENT -->

    <a
        href="<?= site_url('student'); ?>">

        🎓 Student Home

    </a>


    <!-- USERS -->

    <a
        href="<?= site_url('users'); ?>">

        👥 Users

    </a>


    <!-- PRODUCTS -->

    <a
        href="<?= site_url('products'); ?>">

        📦 Products

    </a>


    <!-- ADD PRODUCT -->

    <a
        href="<?= site_url('products/create'); ?>">

        ➕ Add Product

    </a>


    <!-- SETTINGS -->

    <a href="#">

        ⚙️ Settings

    </a>


    <!-- LOGOUT -->

    <a
        href="<?= site_url('logout'); ?>">

        🚪 Logout

    </a>

</div>


<!-- ==========================================
     MAIN CONTENT
     ========================================== -->

<div class="main">


    <!-- PAGE TITLE -->

    <div class="top-title">

        <h1>
            Student Dashboard
        </h1>

        <p>
            Your account information and profile.
        </p>

    </div>


    <!-- ==========================================
         PROFILE CARD
         ========================================== -->

    <div class="profile-card">


        <!-- PROFILE HEADER -->

        <div class="profile-header">


            <!-- FIRST LETTER OF FIRST NAME -->

            <div class="profile-icon">

                <?= strtoupper(
                    substr(
                        $student->firstname,
                        0,
                        1
                    )
                ); ?>

            </div>


            <!-- ACTUAL DATABASE NAME -->

            <div>

                <h2>

                    <?= htmlspecialchars(
                        $student->firstname
                        . ' '
                        . $student->lastname
                    ); ?>

                </h2>


                <p>

                    @<?= htmlspecialchars(
                        $student->username
                    ); ?>

                </p>

            </div>

        </div>


        <!-- ==========================================
             WELCOME
             ========================================== -->

        <div class="welcome">

            <h3>

                Welcome,
                <?= htmlspecialchars(
                    $student->firstname
                ); ?>!

            </h3>


            <p>

                You are successfully logged in.
                This dashboard is your home page.

            </p>

        </div>


        <!-- ==========================================
             INFORMATION
             ========================================== -->

        <div class="info-grid">


            <!-- FIRST NAME -->

            <div class="info-box">

                <label>
                    First Name
                </label>


                <strong>

                    <?= htmlspecialchars(
                        $student->firstname
                    ); ?>

                </strong>

            </div>


            <!-- LAST NAME -->

            <div class="info-box">

                <label>
                    Last Name
                </label>


                <strong>

                    <?= htmlspecialchars(
                        $student->lastname
                    ); ?>

                </strong>

            </div>


            <!-- EMAIL -->

            <div class="info-box">

                <label>
                    Email
                </label>


                <strong>

                    <?= htmlspecialchars(
                        $student->email
                    ); ?>

                </strong>

            </div>


            <!-- USERNAME -->

            <div class="info-box">

                <label>
                    Username
                </label>


                <strong>

                    <?= htmlspecialchars(
                        $student->username
                    ); ?>

                </strong>

            </div>


            <!-- USER ID -->

            <div class="info-box">

                <label>
                    User ID
                </label>


                <strong>

                    <?= htmlspecialchars(
                        $student->id
                    ); ?>

                </strong>

            </div>

        </div>

    </div>

</div>


<!-- ==========================================
     MOBILE MENU
     ========================================== -->

<script>

function toggleMenu()
{
    document
        .getElementById("sidebar")
        .classList
        .toggle("open");
}

</script>


</body>

</html>