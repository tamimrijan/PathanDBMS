<?php
session_start();
require_once "dbconnection.php"; // Include your database connection file

// Check if user is an admin
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>
            alert('Access Denied!');
            window.location.href='index.php';
          </script>";
    exit;
}

$error = "";
$success = "";

// Handle adding a new admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($username) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            $plain_password = $password;

            // Insert new admin into the database
            $query = "INSERT INTO admin (username, password) VALUES (?, ?)";
            $stmt = $dbcon->prepare($query);
            $stmt->bind_param("ss", $username, $plain_password);

            if ($stmt->execute()) {
                $success = "Admin account created successfully!";
            } else {
                $error = "Error creating admin account. Username might already exist.";
            }
            $stmt->close();
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "All fields are required.";
    }
}

$dbcon->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="icon" type="image/x-icon" href="upre011.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf');
        }

        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            margin: 0;
            padding: 60px 0 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #e74c3c;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
            font-family: 'Li Ador Noirrit SemiBold';
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: black;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #000000;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            font-family: 'Li Ador Noirrit SemiBold';
        }
    </style>
</head>

<body>

    <div class="container">
        <div>
        <h5>
            <a href="dashboard.php" style="float: left; margin-left:20px;">Back to Dashboard</a>
        </h5>
        <h5>
            <a href="logout.php" style="float: right; margin-right:20px;">Log Out</a>
        </h5>
    </div>
        <h2>Add Admin</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
            </div>
            <button type="submit" name="add_admin" class="btn btn-primary">Add Admin</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
    </div>
</body>

</html>