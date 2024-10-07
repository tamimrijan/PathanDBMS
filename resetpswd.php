<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Li+Ador+Noirrit+SemiBold&display=swap" rel="stylesheet">
    <title>এইটা কেউ ভুলে ? বোকাচন্দ্র</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
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
            font-family: 'Li Ador Noirrit SemiBold', 'Times New Roman', Times, serif;
        }

        .reset-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 30px;
            width: 450px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            font-family: 'Li Ador Noirrit SemiBold', 'Times New Roman', Times, serif;
        }

        .reset-container h1 {
            text-align: center;
            color: #e84118; /* Same as login form */
            margin-bottom: 15px;
            font-size: 32px;
        }

        .reset-container p {
            text-align: center;
            color: #273c75; /* Matching color from login */
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .reset-container .form-group {
            margin-bottom: 20px;
        }

        .reset-container .form-control {
            border-radius: 30px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        .reset-container .form-control:focus {
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

        .reset-container p a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .reset-container p a:hover {
            color: #2980b9;
        }

        .back-to-login {
            display: flex;
            justify-content:center;
            align-items: center;
            margin-top: 10px;
        }

        .back-to-login img {
            width: 50px;
            height: 50px;
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

        .reset-container img {
            display: block;
            margin: 0 auto 15px;
            height: 100px;
            transition: transform 0.5s;
        }

        .reset-container img:hover {
            transform: scale(1.2);
        }

        .note {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <img src="final.png" alt="Logo" />
        <h1>Password Reset</h1>
        <p>Verify your details to reset your password</p>
        <form action="resetpswd.php" method="get">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Verify Email">
            </div>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </form>
        <div class="back-to-login">
            <a href="index.php">Back to Login</a>
        </div>
        <p class="note">Notice: Email must be registered to reset your password.</p>
    </div>
</body>
</html>
