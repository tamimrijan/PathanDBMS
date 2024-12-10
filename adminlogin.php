<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>পাঠান - ADMIN</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">

    <style>
        /* Load 'Li Ador Noirrit SemiBold' locally */
        /* Add custom font if not already linked */
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

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

        .login-box {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 40px;
            width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .login-box h1 {
            font-size: 35px;
            margin-bottom: 25px;
            color: #e84118;
            letter-spacing: 2px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .textbox {
            position: relative;
            margin-bottom: 25px;
        }

        .textbox i {
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #ff3c00;
        }

        .textbox input {
            width: 80%;
            padding: 12px 15px 12px 40px;
            font-size: 16px;
            border-radius: 30px;
            border: 1px solid #ddd;
            outline: none;
            background: rgba(255, 255, 255, 0.6);
            color: black;
            transition: 0.3s ease;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .textbox input:focus {
            border-color: #e74c3c;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(231, 76, 60, 0.5);
        }

        .button {
            background-color: #e74c3c;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 30px;
            width: 100%;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .button:hover {
            background-color: white;
            color: #e74c3c;
            border: 2px solid #e74c3c;
        }

        .back-button {
            background-color: transparent;
            color: #3498db;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="validate.php" method="post">
            <div class="login-box">
               <a href="../index.php"> <img src="final.png" alt="Pathao" height="250" /></a>
                <h1>ADMIN LOGIN</h1>

                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="example@pathanbd.rocks" name="username" required>
                </div>

                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Enter Your Password" name="password" required>
                </div>

                <input class="button" type="submit" name="login" value="Sign In">

                <!-- Back to Login Page Link -->
                <button type="button" class="back-button" onclick="window.location.href='index.php'">
                    Back to Login Page
                </button>
            </div>
        </form>
    </div>
</body>

</html>
