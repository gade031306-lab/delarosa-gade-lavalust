<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

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

        /* =========================
           LAYOUT
        ========================= */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 240px;
            background: #1e293b;
            color: white;
            padding: 25px 15px;

            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            overflow-y: auto;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            margin: 20px 10px 8px;

            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;

            color: #cbd5e1;
            text-decoration: none;

            padding: 12px 15px;
            border-radius: 8px;

            margin-bottom: 5px;

            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 240px;
            width: calc(100% - 240px);
            padding: 30px;
        }

        .topbar {
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #111827;
        }

        .topbar p {
            color: #64748b;
            margin-top: 6px;
        }

        /* =========================
           PROFILE CARD
        ========================= */

        .profile-card {
            background: white;
            border-radius: 12px;
            padding: 30px;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);

            max-width: 900px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;

            padding-bottom: 25px;
            margin-bottom: 25px;

            border-bottom: 1px solid #e5e7eb;
        }

        .avatar {
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
        }

        .profile-header h2 {
            font-size: 23px;
            color: #111827;
        }

        .profile-header p {
            color: #64748b;
            margin-top: 5px;
        }

        /* =========================
           INFORMATION GRID
        ========================= */

        .info-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 18px;
        }

        .info-box {
            background: #f8fafc;

            border: 1px solid #e5e7eb;

            border-radius: 8px;

            padding: 18px;
        }

        .info-box .label {
            display: block;

            color: #64748b;

            font-size: 12px;

            text-transform: uppercase;

            font-weight: bold;

            margin-bottom: 7px;
        }

        .info-box .value {
            color: #111827;

            font-size: 16px;

            font-weight: 500;

            word-break: break-word;
        }

        /* =========================
           QUICK ACTIONS
        ========================= */

        .quick-actions {
            margin-top: 25px;
        }

        .quick-actions h3 {
            margin-bottom: 15px;
            color: #111827;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-button {
            display: inline-block;

            padding: 11px 17px;

            border-radius: 7px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;
        }

        .action-button:hover {
            background: #1d4ed8;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 768px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                width: calc(100% - 200px);

                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .sidebar {
                width: 180px;
            }

            .main {
                margin-left: 180px;
                width: calc(100% - 180px);

                padding: 15px;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

</head>

<body>

<div class="layout">

    <!-- =========================
         LEFT SIDEBAR
    ========================= -->

    <aside class="sidebar">

        <div class="logo">
            Gade's Student Hub
        </div>


        <div class="menu-title">
            Main
        </div>

        <!-- DASHBOARD -->

        <a href="<?= site_url('student/profile'); ?>" class="active">
            🏠 Dashboard
        </a>


        <!-- STUDENT HOME -->

        <a href="<?= site_url('student'); ?>">
            🎓 Student Home
        </a>


        <div class="menu-title">
            Management
        </div>


        <!-- USERS -->

        <a href="<?= site_url('users'); ?>">
            👥 Users
        </a>


        <!-- PRODUCTS -->

        <a href="<?= site_url('products'); ?>">
            📦 Products
        </a>


        <!-- ADD PRODUCT -->

        <a href="<?= site_url('products/create'); ?>">
            ➕ Add Product
        </a>


        <div class="menu-title">
            System
        </div>


        <!-- SETTINGS - TEMPORARY -->

        <a href="#">
            ⚙️ Settings
        </a>


        <!-- LOGOUT - TEMPORARY -->

        <a href="#">
            🚪 Logout
        </a>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="main">

        <div class="topbar">

            <h1>Student Dashboard</h1>

            <p>
                Welcome to your Student Information Management System.
            </p>

        </div>


        <div class="profile-card">

            <div class="profile-header">

                <div class="avatar">
                    <?= strtoupper(substr($name, 0, 1)); ?>
                </div>

                <div>

                    <h2>
                        <?= htmlspecialchars($name); ?>
                    </h2>

                    <p>
                        Student Profile
                    </p>

                </div>

            </div>


            <div class="info-grid">


                <div class="info-box">

                    <span class="label">
                        Student ID
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($student_id); ?>
                    </span>

                </div>


                <div class="info-box">

                    <span class="label">
                        Name
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($name); ?>
                    </span>

                </div>


                <div class="info-box">

                    <span class="label">
                        Course
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($course); ?>
                    </span>

                </div>


                <div class="info-box">

                    <span class="label">
                        Year Level
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($year); ?>
                    </span>

                </div>


                <div class="info-box">

                    <span class="label">
                        Section
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($section); ?>
                    </span>

                </div>


                <div class="info-box">

                    <span class="label">
                        Email
                    </span>

                    <span class="value">
                        <?= htmlspecialchars($email); ?>
                    </span>

                </div>

            </div>


            <!-- QUICK ACTIONS -->

            <div class="quick-actions">

                <h3>
                    Quick Access
                </h3>

                <div class="action-buttons">

                    <a
                        href="<?= site_url('student'); ?>"
                        class="action-button">
                        🎓 Student Home
                    </a>

                    <a
                        href="<?= site_url('users'); ?>"
                        class="action-button">
                        👥 View Users
                    </a>

                    <a
                        href="<?= site_url('products'); ?>"
                        class="action-button">
                        📦 Manage Products
                    </a>

                </div>

            </div>

        </div>

    </main>

</div>

</body>

</html>