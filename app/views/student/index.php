<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Home | Student Hub</title>

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

        .card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 800px;
        }

        .card h2 {
            font-size: 25px;
            margin-bottom: 15px;
            color: #111827;
        }

        .card p {
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .buttons {
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

            .card {
                padding: 22px;
            }

            .buttons {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <header class="mobile-header">
        <h2>🎓 Student Hub</h2>

        <button class="menu-button" onclick="toggleMenu()">
            ☰
        </button>
    </header>


    <aside class="sidebar" id="sidebar">

        <h2>🎓 Student Hub</h2>

        <a href="<?= site_url('student/profile'); ?>">
            🏠 Dashboard
        </a>

        <a href="<?= site_url('student'); ?>" class="active">
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


    <main class="main">

        <div class="header">
            <h1>Student Home</h1>
            <p>Welcome to Gade's Student Hub.</p>
        </div>

        <div class="card">

            <h2>🎓 Welcome!</h2>

            <p>
                Welcome to the Student Hub. Use the navigation menu
                on the left side to access your dashboard, users,
                products, and other available features.
            </p>

            <div class="buttons">

                <a href="<?= site_url('student/profile'); ?>" class="button">
                    🏠 View Dashboard
                </a>

                <a href="<?= site_url('users'); ?>" class="button">
                    👥 View Users
                </a>

                <a href="<?= site_url('products'); ?>" class="button">
                    📦 View Products
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