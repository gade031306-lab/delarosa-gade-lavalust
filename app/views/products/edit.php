<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product | Student Hub</title>

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
            max-width: 800px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h2 {
            margin-bottom: 25px;
            color: #111827;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #374151;
        }

        input,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-family: inherit;
            font-size: 14px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .update {
            background: #2563eb;
            color: white;
        }

        .update:hover {
            background: #1d4ed8;
        }

        .cancel {
            background: #6b7280;
            color: white;
        }

        .cancel:hover {
            background: #4b5563;
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
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .button {
                width: 100%;
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
            <h1>Edit Product</h1>
            <p>Update the information of this product.</p>
        </div>

        <div class="card">

            <h2>✏️ Product Information</h2>

            <form
                action="<?= site_url('products/update/' . $product['id']); ?>"
                method="POST">

                <div class="form-group">

                    <label for="product_name">
                        Product Name
                    </label>

                    <input
                        type="text"
                        id="product_name"
                        name="product_name"
                        value="<?= htmlspecialchars($product['product_name']); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                    ><?= htmlspecialchars($product['description']); ?></textarea>

                </div>

                <div class="form-group">

                    <label for="price">
                        Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        min="0"
                        value="<?= htmlspecialchars($product['price']); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="quantity">
                        Quantity
                    </label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        min="0"
                        value="<?= htmlspecialchars($product['quantity']); ?>"
                        required>

                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="button update">
                        Update Product
                    </button>

                    <a
                        href="<?= site_url('products'); ?>"
                        class="button cancel">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </main>


    <script>
        function toggleMenu() {
            document.getElementById("sidebar").classList.toggle("open");
        }
    </script>

</body>
</html>