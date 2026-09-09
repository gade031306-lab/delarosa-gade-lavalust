<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GadeLust</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa, #e8ecf1);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 30px;
            color: #222;
            margin-bottom: 8px;
        }

        .logo p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #555;
        }

        .login-btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #222;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #444;
        }

        .error {
            background: #ffe5e5;
            color: #b00020;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }

        .success {
            background: #e5f8e9;
            color: #187333;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #222;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .login-container {
                padding: 30px 22px;
            }

            .logo h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">
        <h1>GadeLust</h1>
        <p>Product Management System</p>
    </div>

    <?php if (isset($_SESSION['login_error'])): ?>

        <div class="error">
            <?= $_SESSION['login_error']; ?>
        </div>

        <?php unset($_SESSION['login_error']); ?>

    <?php endif; ?>


    <?php if (isset($_SESSION['register_success'])): ?>

        <div class="success">
            <?= $_SESSION['register_success']; ?>
        </div>

        <?php unset($_SESSION['register_success']); ?>

    <?php endif; ?>


    <form action="<?= site_url('login/authenticate'); ?>" method="POST">

        <div class="form-group">
            <label for="username">Username</label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter your username"
                required
            >
        </div>


        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >
        </div>


        <button type="submit" class="login-btn">
            Login
        </button>

    </form>


    <div class="register-link">
        Don't have an account?
        <a href="<?= site_url('register'); ?>">
            Create Account
        </a>
    </div>

</div>

</body>
</html>