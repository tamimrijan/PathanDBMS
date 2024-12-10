<?php
// Start session
session_start();

// Database connection
$conn = new mysqli("localhost", "pathanbd_courierdb", "gameloft101", "pathanbd_courierdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify user session
if (!isset($_SESSION['uid'])) {
    header('Location: ../index.php');
    exit();
}

// Get user ID from session
$uid = $_SESSION['uid'];

// Fetch user profile details
$sql_profile = "SELECT * FROM profile WHERE u_id = ?";
$stmt_profile = $conn->prepare($sql_profile);
$stmt_profile->bind_param("i", $uid);
$stmt_profile->execute();
$result_profile = $stmt_profile->get_result();

if ($result_profile->num_rows > 0) {
    $profile = $result_profile->fetch_assoc();
} else {
    echo "Profile not found.";
    exit;
}

// Fetch the number of couriers completed by the user
$sql_couriers = "SELECT COUNT(*) AS courier_count FROM courier WHERE u_id = ?";
$stmt_couriers = $conn->prepare($sql_couriers);
$stmt_couriers->bind_param("i", $uid);
$stmt_couriers->execute();
$result_couriers = $stmt_couriers->get_result();
$courier_data = $result_couriers->fetch_assoc();
$courier_count = $courier_data['courier_count'] ?? 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="icon" type="image/x-icon" href="../favicon01.png">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            background-image: url('bg.jpg'); /* Use bg.jpg as background */
            background-size: cover; /* Cover the full screen */
            background-position: center center; /* Center the image */
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif; /* Use the custom font */
            color: #000; /* Black text */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .profile-container {
            background: #fff; /* White background */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Black shadow */
            max-width: 500px;
            width: 90%;
            text-align: center;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* Makes the photo round */
            border: 5px solid #ff1a1a; /* Red border */
            margin: 20px auto;
            display: block;
        }

        h1 {
            color: #000; /* Black heading */
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
            font-size: 1.2rem;
        }

        button {
            padding: 10px 20px;
            background-color: #ff1a1a; /* Red button */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #e60000; /* Darker red */
        }

        .footer {
            margin-top: auto;
            width: 100%;
            background-color: #1c1c1c;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            position: auto;
        }

        .footer a {
            color: #ff1a1a; /* Red link */
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            color: #e60000; /* Darker red */
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="profile-container">
        <img src="profilepic.png" alt="Profile Photo" class="profile-photo">
        <h1>আপনার প্রোফাইল</h1>
        <p><strong>নাম:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
        <p><strong>ইমেইল:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>
        <p><strong>ঠিকানা:</strong> <?php echo htmlspecialchars($profile['address'] ?? 'N/A'); ?></p>
        <p><strong>ফোন নম্বর:</strong> <?php echo htmlspecialchars($profile['phone'] ?? 'N/A'); ?></p>
        <p><strong>কুরিয়ার সম্পন্ন হয়েছে:</strong> <?php echo $courier_count; ?></p>
        <button onclick="window.location.href='editprofile.php';">Edit Profile</button>
    </div>
    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>
</html>
