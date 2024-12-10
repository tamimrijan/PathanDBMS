<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Li+Ador+Noirrit+SemiBold&display=swap" rel="stylesheet">
    <title>যোগাযোগ করুন</title>
    <link rel="icon" type="image/x-icon" href="upre.png">
    <style>
    @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', 'Times New Roman', Times, serif;
        }

        .contact-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: absolute; /* Centering via absolute positioning */
            top: 52%; /* Move down to the center */
            left: 50%; /* Move right to the center */
            transform: translate(-50%, -50%); /* Center it perfectly */
        }

        .contact-container h1 {
            text-align: center;
            color: #e84118; /* Same as login form */
            margin-bottom: 15px;
            font-size: 32px;
        }

        .contact-container p {
            text-align: center;
            color: #273c75; /* Matching color from login */
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .contact-container .form-group {
            margin-bottom: 20px;
        }

        .contact-container .form-control {
            border-radius: 30px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        .contact-container .form-control:focus {
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
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: white;
            color: #e74c3c;
            border-color: #e74c3c;
        }

        .contact-container p a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-container p a:hover {
            color: #2980b9;
        }

        .back-to-login {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .back-to-login img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .back-to-login a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }

        .back-to-login a:hover {
            color: #2980b9;
        }

        .contact-container img {
            display: block;
            margin: 0 auto 15px;
            height: 95px;
            transition: transform 0.5s;
        }

        .contact-container img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="contact-container">
        <img src="final.png" alt="Logo" />
        <h1>Contact Us</h1>
        <p>We would love to hear from you!</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form-control" rows="4" placeholder="Your message here" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Send Message">
            </div>
        </form>
        <div class="back-to-login">
            <a href="https://www.pathanbd.rocks/index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>

<?php
// Contact form submission handling (basic example)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Simple validation for empty fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare email
        $to = "admin@example.com"; // Change to your admin email
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";

        // Send email (for real-world, you'd need a server that supports sending emails)
        if (mail($to, $subject, $body, $headers)) {
            echo "<script>alert('Message sent successfully.');</script>";
        } else {
            echo "<script>alert('Failed to send the message.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>
