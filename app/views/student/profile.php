<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Student Hub</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            overflow-x: hidden;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #1f2937;
            color: white;
            padding: 25px 15px;
            z-index: 1000;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 8px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        /* =========================
           MOBILE HEADER
        ========================= */

        .mobile-header {
            display: none;
        }

        .menu-button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 9px 13px;
            border-radius: 7px;
            font-size: 20px;
            cursor: pointer;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 240px;
            padding: 35px;
            min-height: 100vh;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 30px;
            color: #111827;
            margin-bottom: 8px;
        }

        .header p {
            color: #6b7280;
        }

        /* =========================
           PROFILE
        ========================= */

        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 800px;
        }

        .profile-card h2 {
            margin-bottom: 25px;
            color: #111827;
        }

        .info {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #374151;
        }

        .value {
            color: #4b5563;
            word-break: break-word;
        }

        .actions {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button {
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .button:hover {
            background: #1d4ed8;
        }

        /* =========================
           PHONE
        ========================= */

        @media (max-width: 768px) {

            .sidebar {
                position: fixed;
                top: 60px;
                left: 0;
                width: 100%;
                height: auto;
                max-height: 0;
                overflow: hidden;
                padding: 0 15px;
                transition: max-height 0.3s ease;
            }

            .sidebar.open {
                max-height: 500px;
                padding: 15px;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                margin-bottom: 6px;
            }

            .mobile-header {
                display: flex;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 60px;
                background: #1f2937;
                color: white;
                align-items: center;
                justify-content: space-between;
                padding: 0 15px;
                z-index: 1100;
            }

            .mobile-header h2 {
                font-size: 18px;
            }

            .main {
                margin-left: 0;
                padding: 85px 18px 25px;
            }

            .header h1 {
                font-size: 25px;
            }

            .profile-card {
                padding: 20px;
            }

            .info {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- MOBILE HEADER -->
    <header class="mobile-header">
        <h2>🎓 Student Hub</h2>

        <button class="menu-button" onclick="toggleMenu()">
            ☰
        </button>
    </header>


    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <h2>🎓 Student Hub</h2>

        <a href="<?= site_url('student/profile'); ?>" class="active">
            🏠 Dashboard
        </a>

        <a href="<?= site_url('student'); ?>">
            🎓 Student Home
        </a>

        <a href="<?= site_url('users'); ?>">
            👥 Users
        </a>

        <a href="<?= site_url('products'); ?>">
            📦 Products
        </a>

        <a href="<?= site_url('products/create'); ?>">
            ➕ Add Product
        </a>

        <a href="#">
            ⚙️ Settings
        </a>

        <a href="<?= site_url('logout'); ?>">🚪 Logout</a>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <div class="header">
            <h1>Dashboard</h1>
            <p>Welcome to your Student Hub.</p>
        </div>

        <div class="profile-card">

            <h2>👤 Student Profile</h2>

            <div class="info">
                <div class="label">Student ID</div>
                <div class="value">
                    <?= htmlspecialchars($student_id); ?>
                </div>
            </div>

            <div class="info">
                <div class="label">Name</div>
                <div class="value">
                    <?= htmlspecialchars($name); ?>
                </div>
            </div>

            <div class="info">
                <div class="label">Course</div>
                <div class="value">
                    <?= htmlspecialchars($course); ?>
                </div>
            </div>

            <div class="info">
                <div class="label">Year</div>
                <div class="value">
                    <?= htmlspecialchars($year); ?>
                </div>
            </div>

            <div class="info">
                <div class="label">Section</div>
                <div class="value">
                    <?= htmlspecialchars($section); ?>
                </div>
            </div>

            <div class="info">
                <div class="label">Email</div>
                <div class="value">
                    <?= htmlspecialchars($email); ?>
                </div>
            </div>

            <div class="actions">

                <a href="<?= site_url('student'); ?>" class="button">
                    🎓 Student Home
                </a>

                <a href="<?= site_url('users'); ?>" class="button">
                    👥 View Users
                </a>

                <a href="<?= site_url('products'); ?>" class="button">
                    📦 Manage Products
                </a>

            </div>

        </div>

    </main>


    <script>
        function toggleMenu() {
            document.getElementById("sidebar").classList.toggle("open");
        }
    </script>

</body>
</html>