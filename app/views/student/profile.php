<!DOCTYPE html>
<html>
<head>
    <title>Gade's Student Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 50px;
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
            text-align: center;
            color: #333;
        }

        .info {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
        }

        .nav {
            text-align: center;
            margin-top: 25px;
        }

        a {
            display: inline-block;
            padding: 10px 18px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 5px;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Student Information</h1>

    <div class="info">
        <span class="label">Student ID:</span>
        <?= $student_id; ?>
    </div>

    <div class="info">
        <span class="label">Name:</span>
        <?= $name; ?>
    </div>

    <div class="info">
        <span class="label">Course:</span>
        <?= $course; ?>
    </div>

    <div class="info">
        <span class="label">Year Level:</span>
        <?= $year; ?>
    </div>

    <div class="info">
        <span class="label">Section:</span>
        <?= $section; ?>
    </div>

    <div class="info">
        <span class="label">Email:</span>
        <?= $email; ?>
    </div>

    <div class="nav">
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
    </div>

</div>

</body>
</html>