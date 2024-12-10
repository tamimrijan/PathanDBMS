<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>পাঠান - দেশের ১ নম্বর ডিজিটাল প্ল্যাটফর্ম</title>
    <link rel="icon" type="image/x-icon" href="upre.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Li+Ador+Noirrit+SemiBold&display=swap" rel="stylesheet">
    
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Li Ador Noirrit SemiBold', 'Times New Roman', Times, serif;
        }

        .navbar {
            background-color: #e74c3c; /* Red background */
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Shadow effect */
            margin: 10px auto;
            width: 90%;
            max-width: 1100px;
        }

        .navbar-brand {
            font-size: 24px;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .navbar-brand img {
            height: 70px; /* Small logo size */
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 18px;
            font-weight: 500;
            margin-right: 20px;
            transition: color 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcccc; /* Lighter red hover effect */
        }

        .navbar-toggler {
            border: none;
            background-color: white;
        }

        .navbar-collapse {
            justify-content: space-between;
        }

        .ml-auto .nav-link {
            color: white;
            font-weight: bold;
        }

        .ml-auto .nav-link:hover {
            color: #ffcccc; /* Lighter red hover effect for right-side links */
        }

        /* Dropdown Styles */
        .dropdown-menu {
            background-color: #e74c3c; /* Red background */
            border-radius: 5px;
        }

        .dropdown-item {
            color: white;
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #ffcccc; /* Lighter red hover effect */
        }

        /* Mobile view adjustments */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                font-size: 16px;
                margin-right: 10px;
            }

            .navbar-brand {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md">
        <a href="home.php" class="navbar-brand">
            <img src="finalhead.png" alt="Logo"> পাঠান <!-- Small logo next to brand name -->
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="home.php" class="nav-item nav-link active">Home</a>
                <a href="price.php" class="nav-item nav-link">Price</a>
                <a href="courierMenu.php" class="nav-item nav-link">Courier</a>
                <a href="trackMenu.php" class="nav-item nav-link">Track</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="contactUS.php" class="nav-item nav-link">Contact Us</a>

                <!-- New Dropdown for Additional Sections -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="feedback.php">Feedback</a>
                        <a class="dropdown-item" href="payment.php">Payment</a>
                        <a class="dropdown-item" href="deliveryOptions.php">Delivery Options</a>
                        <a class="dropdown-item" href="userAddresses.php">User Addresses</a>
                        <a class="dropdown-item" href="courierStatus.php">Courier Status</a>
                        <a class="dropdown-item" href="userRoles.php">User Roles</a>
                        <a class="dropdown-item" href="notifications.php">Notifications</a>
                        <a class="dropdown-item" href="refunds.php">Refunds</a>
                        <a class="dropdown-item" href="discounts.php">Discounts</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="settings.php">Settings</a>
                        <a class="dropdown-item" href="help.php">Help</a>
                    </div>
                </div>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="../admin/logout.php" class="nav-item nav-link">Admin Page</a>
                <a href="../logout.php" class="nav-item nav-link">Log Out</a>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
