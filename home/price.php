<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
}else{
    header('location: ../index.php');
}
?>
<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing</title>
    <link rel="icon" type="image/x-icon" href="upre.png">

    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            font-family: 'Li Ador Noirrit SemiBold', sans-serif;
            background-image: url('bg.jpg'); /* Set the background image */
            background-size: cover; /* Ensure the image covers the entire page */
            background-position: center center; /* Center the image */
            background-attachment: fixed; /* Make the background fixed during scrolling */
            min-height: 100vh; /* Ensure the body takes full height */
            display: flex;
            flex-direction: column;
        }

        h3 {
            color: #ff0000;
            text-align: center; /* Center-align the heading */
        }

        table {
            width: 50%;  /* Make the table larger */
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            font-weight: bold;
            border-collapse: collapse;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Floating table effect */
        }

        th, td {
            padding: 10px; /* Add some padding for text clarity */
            text-align: center; /* Center-align all text */
        }

        th {
            background-color: #e60000; /* Red */
            color: #ffffff;
            font-size: 30px;
        }

        td {
            background-color: #ffffff; /* White */
            color: #000000;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2; /* Light Gray for even rows */
        }

        ol {
            color: #000000;
            font-weight: bold;
        }

        ol li {
            color: #000000;
        }

        /* Footer Styles */
        .footer {
            background-color: #000000; /* Dark footer background */
            color: #ffffff; /* White text */
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        .footer a {
            color: #ff0000; /* Red links */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffffff; /* Change to white on hover */
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Weight in Kg</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>0-1</td><td>120</td>
        </tr>
        <tr>
            <td>1-2</td><td>200</td>
        </tr>
        <tr>
            <td>2-4</td><td>250</td>
        </tr>
        <tr>
            <td>4-5</td><td>300</td>
        </tr>
        <tr>
            <td>5-7</td><td>400</td>
        </tr>
        <tr>
            <td>7-above</td><td>500</td>
        </tr>
        <tr>
            <td>Shawon</td><td>350</td>
        </tr>
    </table>

    <h3 style="margin-top:20px;">As per your courier's weight pay the amount on:</h3>

    <div style="margin-left:45%; margin-right:auto;">
        <ol>
            <li>bKash</li>
            <li>Rocket</li>
            <li>Upay</li>
        </ol>
    </div>
    
    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>
</html>