<?php
require_once "session.php";

// Check if OTP is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $enteredOtp = $_POST['otp'];

    // Verify OTP
    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
        // Check OTP expiration (if you want to limit OTP validity time)
        $otpTime = $_SESSION['otp_time'];
        if (time() - $otpTime > 300) { // OTP expires after 5 minutes
            $error = "OTP has expired. Please request a new one.";
        } else {
            // OTP is correct and valid, log the user in
            echo "<script>window.open('home/home.php', '_self');</script>";
        }
    } else {
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        /* Add custom font if not already linked */
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

        .otp-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 30px;
            width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            font-family: 'Li Ador Noirrit SemiBold', sans-serif;
        }

        .otp-container h2 {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .otp-container label {
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            font-size: 18px;
            color: #333;
        }

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

        .otp-container .form-control {
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 20px 15px;
            font-size: 16px;
        }

        .otp-container .form-control:focus {
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
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
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

        .otp-container p {
            text-align: center;
            color: #555;
            margin-top: 20px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .otp-container a {
            color: #3498db;
            text-decoration: none;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            transition: color 0.3s ease;
        }

        .otp-container a:hover {
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

    <div class="otp-container">
        <h2>কি খবর ভাই/বোন ? নিচে OTP দিন</h2>

        <form action="" method="POST">
            <div class="form-group">
                <label for="otp">Enter OTP</label>
                <input type="text" id="otp" name="otp" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Verify OTP" />
            </div>
        </form>

        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    </div>

    <div class="footer">
        <p>
            <span>⚡ Made With Love By TWO NSUERS: <a href="https://www.facebook.com/tamim.ahmed.rijan01/"><strong>Tamim</strong></a> & 
            <a href="https://www.facebook.com/profile.php?id=100069055038747"><strong>Farzana</strong></a> ⚡</span><br>
        </p>
    </div>

</body>

</html>
