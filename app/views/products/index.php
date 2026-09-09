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

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #1f2937;
            color: white;
            padding: 25px 15px;
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

        /* MAIN */
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

        /* CARD */
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
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

        /* ACTIONS */
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

        @media (max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

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

        <a href="#">
            🚪 Logout
        </a>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <div class="header">
            <h1>Products</h1>
            <p>Manage products in the system.</p>
        </div>

        <div class="card">

            <div class="card-header">

                <h2>📦 Product Management</h2>

                <a href="<?= site_url('products/create'); ?>" class="add-button">
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

</body>
</html>