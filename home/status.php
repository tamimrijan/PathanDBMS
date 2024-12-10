<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../login.php');
    }

?>
<?php include('header.php');
    include('../dbconnection.php');
    $idd = $_GET['sidd'];

    $qryy= "SELECT * FROM `courier` WHERE `c_id`='$idd'";
    $run= mysqli_query($dbcon,$qryy);
    $data=mysqli_fetch_assoc($run);
    $stdate = $data['date'];
    $tddate= date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <style>
        /* Font integration */
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        /* Global body styling */
        body {
            margin: 0;
            padding: 0;
            background: url('bg.jpg') no-repeat center center fixed; /* Background image */
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            color: white;
        }

        /* Container styling */
        .status-container {
            text-align: center;
            padding: 50px;
            margin: 100px auto;
            max-width: 800px;
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent black background */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4); /* Red glow effect */
        }

        /* Heading styling */
        .status-container h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: #ff0000; /* Bright red text */
        }

        /* Subheading styling */
        .status-container p {
            font-size: 1.2rem;
            margin: 15px 0;
            color: #ffffff; /* White text */
        }

        /* Divider styling */
        .divider {
            border: 1px solid #fff;
            margin: 20px auto;
            width: 50%;
        }

        /* Button styling */
        .status-button {
            background-color: #ff0000;
            color: white;
            padding: 15px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        /* Button hover effect */
        .status-button:hover {
            background-color: #cc0000;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.6);
        }
    </style>
</head>
<body>
    <?php
    if($stdate == $tddate){
        ?>
        <div class="status-container">
            <h1>🚛 Status: On The Way...</h1>
            <hr class="divider" />
            <button class="status-button" onclick="window.location.href='trackMenu.php'">Go Back</button>
        </div>
        <?php 
    } else {
        ?>
        <div class="status-container">
            <h1>🎉 Status: Items Delivered</h1>
            <p>HAVE A NICE DAY 😊</p>
            <hr class="divider" />
            <button class="status-button" onclick="window.location.href='trackMenu.php'">Go Back</button>
        </div>
        <?php
    }
    ?>
</body>
</html>
