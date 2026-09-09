<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - GadeLust</title>

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

        .register-container {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
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

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 17px;
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #555;
        }

        .register-btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #222;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        .register-btn:hover {
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

        .login-link {
            text-align: center;
            margin-top: 22px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #222;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 550px) {

            body {
                padding: 15px;
            }

            .register-container {
                padding: 28px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .logo h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="logo">
        <h1>Create Account</h1>
        <p>Register for the Product Management System</p>
    </div>


    <?php if (isset($_SESSION['register_error'])): ?>

        <div class="error">
            <?= $_SESSION['register_error']; ?>
        </div>

        <?php unset($_SESSION['register_error']); ?>

    <?php endif; ?>


    <form action="<?= site_url('register/store'); ?>" method="POST">

        <div class="form-row">

            <div class="form-group">
                <label for="firstname">First Name</label>

                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    placeholder="First name"
                    required
                >
            </div>


            <div class="form-group">
                <label for="lastname">Last Name</label>

                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    placeholder="Last name"
                    required
                >
            </div>

        </div>


        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
            >
        </div>


        <div class="form-group">
            <label for="username">Username</label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Create a username"
                required
            >
        </div>


        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Create a password"
                minlength="6"
                required
            >
        </div>


        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Confirm your password"
                minlength="6"
                required
            >
        </div>


        <button type="submit" class="register-btn">
            Create Account
        </button>

    </form>


    <div class="login-link">
        Already have an account?
        <a href="<?= site_url('login'); ?>">
            Login
        </a>
    </div>

</div>

</body>
</html>