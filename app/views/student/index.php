```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gade's Student Hub</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .container {
            background: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 2.5rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        a {
            display: block;
            width: 100%;
            padding: 0.85rem 1rem;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        a:hover {
            background: #1d4ed8;
        }

        a:active {
            transform: scale(0.98);
        }

        @media (min-width: 640px) {
            .container {
                padding: 3rem 2.5rem;
            }

            h1 {
                font-size: 1.85rem;
            }

            .nav-links {
                flex-direction: row;
            }

            a {
                flex: 1;
            }
        }
    </style>
</head>

<body>

<main class="container">

    <h1>Welcome to Gade's Student Hub</h1>

    <p>Student Information Management Page</p>

    <nav class="nav-links">
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Profile</a>
        <a href="<?= site_url('users'); ?>">Users List</a>
    </nav>

</main>

</body>
</html>
```
