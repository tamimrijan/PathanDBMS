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

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql_update = "UPDATE profile SET address = ?, phone = ? WHERE u_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $address, $phone, $uid);

    if ($stmt_update->execute()) {
        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'profile.php';
        </script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        input {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button, input[type="submit"] {
            padding: 10px;
            background-color: #af4c4c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #e87676;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Edit Profile</h1>
        <form method="POST" action="editprofile.php">
            <input type="text" name="address" value="<?php echo htmlspecialchars($profile['address'] ?? ''); ?>" placeholder="Address">
            <input type="text" name="phone" value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>" placeholder="Phone">
            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
