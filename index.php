<?php

require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
?>
        <script>
            alert("Opps! plz Enter Your Username and Pswd again..");
            window.open('index.php', '_self');
        </script> <?php
                } else {
                    $data = mysqli_fetch_assoc($run);
                    $id = $data['u_id'];    //fetch id value of user
                    $email = $data['email'];
                    $_SESSION['uid'] = $id;   //now we can use it until session destroy
                    $_SESSION['emm'] = $email;
                    ?>
        <script>
            alert("Welcome To পাঠান");
            window.open('home/home.php', '_self');
            // changes made here
        </script> <?php

                }
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পাঠান - দেশের ১ নম্বর ডিজিটাল প্ল্যাটফর্ম</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        /* Add custom font if not already linked */
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('fonts/LiAdorNoirritSemiBold.ttf'); /* Ensure your font path is correct */
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
            font-family: 'Arial', sans-serif;
        }

        .login-container h2 {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Apply font style to input labels */
        .login-container label {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            font-size: 18px;
            color: #333;
        }

        /* Apply the same font to input placeholders */
        ::-webkit-input-placeholder {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #999;
        }

        :-moz-placeholder {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #999;
        }

        ::-moz-placeholder {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #999;
        }

        :-ms-input-placeholder {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #999;
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

        .btn-primary,
        .reset-btn {
            background-color: #e74c3c;
            border-color: #e74c3c;
            border-radius: 30px;
            font-size: 18px;
            padding: 12px;
            width: 100%;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif; /* Font applied to buttons */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-primary:hover,
        .reset-btn:hover {
            background-color: white;
            color: #e74c3c;
            border-color: #e74c3c;
        }

        .reset-btn {
            margin-top: 15px;
        }

        .login-container p {
            text-align: center;
            color: #555;
            margin-top: 20px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif; /* Font applied to p */
        }

        .login-container a {
            color: #3498db;
            text-decoration: none;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif; /* Font applied to links */
            transition: color 0.3s ease;
        }

        .login-container a:hover {
            color: #2980b9;
        }

        .login-container img {
            display: block;
            margin: 0 auto 20px;
        }

        .admin-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #c0392b;
            color: white;
            padding: 10px 15px;
            border-radius: 30px;
            font-weight: bold;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif; /* Font applied to Admin button */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .admin-btn img {
            margin-right: 8px;
        }

        .admin-btn:hover {
            background-color: white;
            color: #c0392b;
            border: 2px solid #c0392b;
            text-decoration: none;
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

        .footer span strong {
            color: #e74c3c;
        }

        .footer p span {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Admin Button placed at top-right -->
    <a href="admin/adminlogin.php" class="admin-btn">
        <img src="admin.png" height="30" alt="Admin Login"> Admin
    </a>

    <div class="login-container">
        <img src="final.png" alt="Pathao" height="250" />
        <h2>পাঠান COURIER SERVICE</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="example@pathan.com" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign In" />
            </div>

            <!-- Reset Password Button -->
            <button type="button" onclick="window.location.href='resetpswd.php'" class="btn reset-btn">Reset Password</button>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>

    <!-- Footer with stylish project credits -->
    <div class="footer">
        <p>
            <span>⚡ Crafted with passion by TWO NSUERS: <a href="https://www.facebook.com/tamim.ahmed.rijan01/"><strong>Tamim</strong></a> & 
            <a href="https://www.facebook.com/profile.php?id=100069055038747"><strong>Farzana</strong></a> ⚡</span><br>

        </p>
    </div>

</body>

</html>
