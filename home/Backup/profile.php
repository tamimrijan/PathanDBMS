<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }
        body {
            background-color: #2b2b2b; /* Dark background for black theme */
            font-family: 'Li Ador Noirrit SemiBold', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px); /* Adjust height based on header's height */
            margin-top: 60px; /* Aligns with header */
        }
        .card {
            background-color: #1c1c1c;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            border: none;
            max-width: 600px;
            width: 100%;
        }
        .user-profile {
            background: linear-gradient(to right, #ff4d4d, #e60000); /* Red gradient */
            padding: 20px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            text-align: center;
        }
        .img-radius {
            border-radius: 50%;
            border: 5px solid #fff;
        }
        .f-w-600 {
            font-weight: 600;
            color: #fff;
        }
        .text-muted {
            color: #b3b3b3;
        }
        .card .card-block p {
            color: #ddd;
        }
        h6, p {
            margin: 0;
        }
        .social-link a {
            color: #ff4d4d;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }
        .social-link a:hover {
            color: #e60000;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card user-card-full">
        <div class="row no-gutters">
            <div class="col-sm-4 user-profile">
                <div class="card-block">
                    <div class="m-b-25"> 
                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> 
                    </div>
                    <h3 class="f-w-600"><?php echo $data['name']; ?></h3>
                    <p>user</p>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card-block p-4">
                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Email</p>
                            <h6 class="text-muted f-w-400"><?php echo $data['email']; ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Phone</p>
                            <h6 class="text-muted f-w-400"><?php echo $data['pnumber']; ?></h6>
                        </div>
                    </div>
                    <div class="social-link list-inline m-t-20">
                        <a href="#" class="list-inline-item"><i class="mdi mdi-twitter"></i></a>
                        <a href="#" class="list-inline-item"><i class="mdi mdi-facebook"></i></a>
                        <a href="#" class="list-inline-item"><i class="mdi mdi-instagram"></i></a>
                        <a href="#" class="list-inline-item"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                    <h6 class="text-center mt-4">Leave it when u can't hold it..</h6>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>