<?php
session_start();
require_once "dbconnection.php"; // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<script>
            alert('Please log in first!');
            window.location.href='index.php';
          </script>";
    exit;
}

$user_id = $_SESSION['uid'];
$error = "";
$success = "";

// Fetch current user details
$query = "SELECT * FROM users WHERE u_id = ?";
$stmt = $dbcon->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>
            alert('User not found!');
            window.location.href='index.php';
          </script>";
    exit;
}

// Handle name change
if (isset($_POST['update_name'])) {
    $new_name = trim($_POST['name']);
    if (!empty($new_name)) {
        // Update the name in the `users` table
        $update_user_query = "UPDATE users SET name = ? WHERE u_id = ?";
        $stmt = $dbcon->prepare($update_user_query);
        $stmt->bind_param("si", $new_name, $user_id);

        if ($stmt->execute()) {
            // Update the name in the `profile` table
            $update_profile_query = "UPDATE profile SET name = ? WHERE u_id = ?";
            $stmt = $dbcon->prepare($update_profile_query);
            $stmt->bind_param("si", $new_name, $user_id);

            if ($stmt->execute()) {
                $success = "Name updated successfully in both tables!";
            } else {
                $error = "Failed to update name in the profile table.";
            }
        } else {
            $error = "Failed to update name in the users table.";
        }
    } else {
        $error = "Name cannot be empty.";
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate passwords
    if ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } elseif (empty($current_password) || empty($new_password)) {
        $error = "All fields are required.";
    } else {
        $check_password_query = "SELECT * FROM login WHERE u_id = ? AND password = ?";
        $stmt = $dbcon->prepare($check_password_query);
        $stmt->bind_param("is", $user_id, $current_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $update_password_query = "UPDATE login SET password = ? WHERE u_id = ?";
            $stmt = $dbcon->prepare($update_password_query);
            $stmt->bind_param("si", $new_password, $user_id);
            if ($stmt->execute()) {
                $success = "Password changed successfully!";
            } else {
                $error = "Error updating password.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }
}

// Handle account deletion
if (isset($_POST['delete_account'])) {
    $delete_query = "DELETE FROM users WHERE u_id = ?";
    $stmt = $dbcon->prepare($delete_query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        // Cascade delete will remove all related records (due to foreign key constraints)
        session_destroy();
        echo "<script>
                alert('Account deleted successfully.');
                window.location.href='../index.php';
              </script>";
        exit;
    } else {
        $error = "Error deleting account.";
    }
}

$dbcon->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            margin: 0;
            padding: 60px 0 0; /* Adjust for fixed header */
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            z-index: 1000;
            box-shadow: none;
        }

        .settings-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 500px; /* Adjusted for better form size */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 250px auto;
        }

        h2 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        .btn-primary {
            background-color: #ff0000;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
            margin-bottom: 10px;
            font-family: 'Li Ador Noirrit SemiBold';
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: black;
        }

        .btn-danger {
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
            font-family: 'Li Ador Noirrit SemiBold';
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
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
            font-family: 'Li Ador Noirrit SemiBold';
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
    <header>
        <?php include('header.php'); ?>
    </header>

    <div class="settings-container">
        <h2>আপনার সেটিংস</h2>

        <?php if ($error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success) : ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Update Name -->
        <form method="POST">
            <div class="form-group">
                <label for="name">Update Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <button type="submit" name="update_name" class="btn btn-primary">Update Name</button>
        </form>

        <!-- Change Password -->
        <form method="POST">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
        </form>

        <!-- Delete Account -->
        <form method="POST">
            <button type="submit" name="delete_account" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>

</html>



