<?php

session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="upre.png"/>
    <title>পাঠান এ আপনাকে স্বাগতম </title>
    <style>
        body
        {
        background-image:url('bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div align='center' style="font-weight: bold;font-family:'Times New Roman', Times, serif"><br><br><br><br>
        <h2>This is a পাঠান Courier Management Service</h2>
        <h4>The fastest courier service of North South University</h4><br><br>
        <h3>DBMS PROJECT BY TAMIM & FARZANA</h3>
        <h6>Group 03</h6>
    </div>
</body>
</html>