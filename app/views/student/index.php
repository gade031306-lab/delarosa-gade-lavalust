<!DOCTYPE html>
<html>
<head>
    <title>Gade's Student Hub</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
            padding: 60px;
        }

        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Welcome to Gade's Student Hub</h1>

    <p>Student Information Management Page</p>

    <a href="<?= site_url('student'); ?>">Home</a>
<a href="<?= site_url('student/profile'); ?>">Student Profile</a>

</div>

</body>
</html>