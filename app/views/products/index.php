<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products | Student Hub</title>

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

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .card-header h2 {
            color: #111827;
        }

        .add-button {
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            white-space: nowrap;
        }

        .add-button:hover {
            background: #1d4ed8;
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
            min-width: 850px;
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

        .edit {
            display: inline-block;
            padding: 7px 11px;
            background: #f59e0b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        .delete {
            display: inline-block;
            padding: 7px 11px;
            background: #dc2626;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit:hover {
            background: #d97706;
        }

        .delete:hover {
            background: #b91c1c;
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

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-button {
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

        <a href="<?= site_url('student'); ?>">
            🎓 Student Home
        </a>

        <a href="<?= site_url('users'); ?>">
            👥 Users
        </a>

        <a href="<?= site_url('products'); ?>" class="active">
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
            <h1>Products</h1>
            <p>Manage products in the system.</p>
        </div>

        <div class="card">

            <div class="card-header">

                <h2>📦 Product Management</h2>

                <a
                    href="<?= site_url('products/create'); ?>"
                    class="add-button">
                    ➕ Add Product
                </a>

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($products)): ?>

                            <?php foreach ($products as $product): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars($product['id']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['product_name']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['description']); ?>
                                    </td>

                                    <td>
                                        ₱<?= number_format($product['price'], 2); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['quantity']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['created_at']); ?>
                                    </td>

                                    <td>

                                        <a
                                            href="<?= site_url('products/edit/' . $product['id']); ?>"
                                            class="edit">
                                            Edit
                                        </a>

                                        <a
                                            href="<?= site_url('products/delete/' . $product['id']); ?>"
                                            class="delete"
                                            onclick="return confirm('Are you sure you want to delete this product?');">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="7" style="text-align:center; padding:25px;">
                                    No products found.
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