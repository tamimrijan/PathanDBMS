<?php
session_start();

// Database connection
$servername = "localhost";
$username = "pathanbd_courierdb"; // Replace with your database username
$password = "gameloft101";     // Replace with your database password
$dbname = "pathanbd_courierdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

// Check credentials
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();

    if ($dbPassword && $inputPassword === $dbPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $inputUsername; // Optional: Store username in session
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - পাঠান</title>
    <link rel="icon" type="image/x-icon" href="upre.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 30px;
            width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            font-family: 'Li Ador Noirrit SemiBold', sans-serif;
        }

        .login-container h2 {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .login-container label {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            font-size: 18px;
            color: #333;
        }

        .login-container .form-control {
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 20px 15px;
            font-size: 16px;
        }

        .login-container .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 5px rgba(231, 76, 60, 0.5);
        }

        .btn-primary {
            background-color: #e74c3c;
            border-color: #e74c3c;
            border-radius: 30px;
            font-size: 18px;
            padding: 12px;
            width: 100%;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: white;
            color: #e74c3c;
            border-color: #e74c3c;
        }

        .login-container p {
            text-align: center;
            color: #555;
            margin-top: 20px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .login-container a {
            color: #3498db;
            text-decoration: none;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            transition: color 0.3s ease;
        }

        .login-container a:hover {
            color: #2980b9;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 16px;
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .footer p {
            margin: 0;
        }

        .footer span {
            font-weight: bold;
            color: #e74c3c;
        }

        .footer p span {
            font-size: 12px;
            color: #666;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <a href="../index.php"><img src="final.png" alt="Pathao" height="300"></a>
        <h2>পাঠান ADMIN LOGIN</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <div class="footer">
        <p>
            <span>⚡ Made With Love By TWO NSUERS: <a href="https://www.facebook.com/tamim.ahmed.rijan01/"><strong>Tamim</strong></a> & 
            <a href="https://www.facebook.com/profile.php?id=100069055038747"><strong>Farzana</strong></a> ⚡</span><br>
        </p>
    </div>
</body>

</html>
