<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users | Student Hub</title>

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
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h2 {
            margin-bottom: 20px;
            color: #111827;
        }

        .user-count {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 12px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th,
        td {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background: #f9fafb;
            color: #374151;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody tr:hover {
            background: #f3f4f6;
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
                padding: 85px 12px 25px;
            }

            .header h1 {
                font-size: 25px;
            }

            .card {
                padding: 18px;
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

        <a href="<?= site_url('student'); ?>">
            🎓 Student Home
        </a>

        <a href="<?= site_url('users'); ?>" class="active">
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
            <h1>Users</h1>
            <p>View registered users in the system.</p>
        </div>

        <div class="card">

            <h2>👥 User Management</h2>

            <div class="user-count">
                Total Users: <?= count($users); ?>
            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($users)): ?>

                            <?php foreach ($users as $user): ?>

                                <tr>
                                    <td><?= htmlspecialchars($user['id']); ?></td>
                                    <td><?= htmlspecialchars($user['firstname']); ?></td>
                                    <td><?= htmlspecialchars($user['lastname']); ?></td>
                                    <td><?= htmlspecialchars($user['email']); ?></td>
                                    <td><?= htmlspecialchars($user['username']); ?></td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="5" style="text-align:center; padding:25px;">
                                    No users found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

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