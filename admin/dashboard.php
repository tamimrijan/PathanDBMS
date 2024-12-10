<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>পাঠান - ADMIN DASHBOARD</title>
    <link rel="icon" type="image/x-icon" href="../favicon01.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('../font/Li Ador Noirrit SemiBold.ttf');
        }
        body {
            background-image: url('bg.jpg');
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
            margin: 0;
            color: #f5f6fa;
        }

        .header {
            background-color: rgba(255, 0, 0, 0.8); /* Red background */
            height: 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .header h1 {
            margin: 0;
            font-size: 24px; /* Adjusted for better layout */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .logo {
            height: 150px; /* Adjust height as necessary */
            margin-right: 20px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .nav-links a {
            color: aliceblue;
            font-weight: bold;
            text-decoration: none;
            font-size: 18px;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 100px - 60px); /* Full height minus header and footer */
            text-align: center;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .welcome-message {
            font-size: 36px;
            margin-bottom: 20px;
            color: black; /* Black text */
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

     .options-container {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping to next line if needed */
    justify-content: center; /* Center align cards */
    gap: 20px; /* Add spacing between cards */
    background-color: white; /* White background */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    max-width: 1200px; /* Set maximum container width */
    margin: 20px auto; /* Center the container horizontally */
}

.option-card {
    background-color: white;
    color: black;
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    width: 250px; /* Fixed card width */
    text-align: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s;
}

.option-card:hover {
    transform: translateY(-2px);
}


        .option-card a {
            color: black; /* Black text for links */
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Li Ador Noirrit SemiBold', Times, serif;
        }

        .option-card a:hover {
            text-decoration: underline;
        }

        /* Footer Styles */
        .footer {
            background-color: rgba(0, 0, 0, 0.8); /* Dark background */
            color: #f5f6fa;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .options-container {
                width: 90%; /* Adjust width on mobile */
            }
            .header h1 {
                font-size: 20px; /* Smaller font size on mobile */
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="../index.php"><img src="../home/finalhead.png" alt="Logo" class="logo"></a> <!-- Replace with your logo path -->
        <h1>পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম</h1>
        <div class="nav-links">
            <a href="../index.php">Login As User</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <div class="content">
        <img src="../final.png" alt="Pathao" height="250" />
        <div class="welcome-message">Welcome To Dashboard</div>
        <div class="options-container">
            <div class="option-card">
                <a href="deleteusers.php">Delete Users</a>
            </div>
            <div class="option-card">
                <a href="deletedata.php">Delete Data</a>
            </div>
            <div class="option-card">
                <a href="refund_approval.php">Refund Approval</a>
            </div>
            <div class="option-card">
                <a href="courier_status.php">Manage Couriers</a>
            </div>
            <div class="option-card">
                <a href="admin_discount.php">Manage Discounts</a>
            </div>
            <div class="option-card">
                <a href="add_admin.php">Add Admin</a>
            </div>
            <div class="option-card">
                <a href="view_feedback.php">View Feedback</a>
            </div>
            <div class="option-card">
                <a href="view_help.php">View Help</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>Made With Love 🧡 By <a href="https://www.facebook.com/tamim.ahmed.rijan01/">Tamim</a> And <a href="https://www.facebook.com/profile.php?id=100069055038747">Farzana</a>
        </p>
    </div>

</body>
</html>
