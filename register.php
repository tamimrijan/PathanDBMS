<?php
require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = $_POST['name'];
    $phn = $_POST['ph'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if($password == $confirm_password) {
        $qry = "INSERT INTO `users` (`email`, `name`, `pnumber`) VALUES ('$email', '$fullname', '$phn')";
        $run = mysqli_query($dbcon, $qry);
    
        if($run == true) {
            $psqry = "INSERT INTO `login` (`email`, `password`, `u_id`) VALUES ('$email', '$password', LAST_INSERT_ID())";
            $psrun = mysqli_query($dbcon, $psqry);
            ?>  
            <script>
                alert('Registration Successfully :)'); 
                window.open('index.php','_self');
            </script>
            <?php
        }
    } else {
        ?>  
        <script>
            alert('Password mismatched!!'); 
        </script>
        <?php
    }
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রেজিস্ট্রেশন করুন - দেশের ১ নম্বর ডিজিটাল প্ল্যাটফর্ম</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Li+Ador+Noirrit+SemiBold&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.85); /* Transparent white background */
            border-radius: 15px;
            padding: 30px;
            width: 550px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Smooth shadow */
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .register-container h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        .register-container img {
            display: block;
            margin: 0 auto 20px;
            height: 150px;
        }

        .register-container .form-control {
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 15px;
            font-size: 16px;
        }

        .register-container .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 5px rgba(231, 76, 60, 0.5); /* Soft focus effect */
        }

        .btn-danger {
            background-color: #e74c3c; /* Red color */
            border-color: #e74c3c;
            border-radius: 30px;
            font-size: 18px;
            padding: 12px;
            width: 100%;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: white; /* White on hover */
            color: #e74c3c; /* Red text on hover */
            border-color: #e74c3c;
        }

        .register-container p {
            text-align: center;
            color: #555;
            margin-top: 20px;
            font-size: 16px;
        }

        .register-container a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-container a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <img src="final.png" alt="Logo" />
        <h2>Register</h2>
        <p>Please fill this form to create an account.</p>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ph">Phone Number</label>
                <input type="number" id="ph" name="ph" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-danger" value="Register">
            </div>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a>.</p>
    </div>

</body>
</html>
