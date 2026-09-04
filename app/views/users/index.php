
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>

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
            padding: 1.5rem 1rem;
        }

        .container {
            background: #ffffff;
            width: 100%;
            max-width: 800px;
            padding: 2rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            font-size: 1.6rem;
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            min-width: 500px;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.95rem;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:nth-child(even) {
            background-color: #fbfbfb;
        }

        tr:hover {
            background-color: #f3f4f6;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        a {
            display: block;
            text-align: center;
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
                padding: 2.5rem;
            }

            h1 {
                font-size: 1.85rem;
            }

            .nav {
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

    <h1>Users List</h1>

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

                <?php foreach ($users as $user): ?>

                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <nav class="nav">
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
    </nav>

</main>

</body>
</html>

