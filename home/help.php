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

// Handle help request submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_help'])) {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($subject) && !empty($message)) {
        $query = "INSERT INTO help_requests (u_id, subject, message) VALUES (?, ?, ?)";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("iss", $user_id, $subject, $message);
        if ($stmt->execute()) {
            $success = "Help request submitted successfully!";
        } else {
            $error = "Error submitting help request.";
        }
        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}

// Fetch all help requests for the user
$query = "SELECT * FROM help_requests WHERE u_id = ? ORDER BY submitted_at DESC";
$stmt = $dbcon->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dbcon->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf');
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

        .help-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: 200px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
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
            background-color: #e74c3c;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
            font-family: 'Li Ador Noirrit SemiBold';
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: black;
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

        .help-list {
            margin-top: 30px;
        }

        .help-item {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .help-item h4 {
            margin: 0 0 10px;
            color: #333;
        }

        .help-item p {
            margin: 0;
            color: #555;
        }

        .help-item .date {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .footer {
            background-color: #000000;
            color: #ffffff;
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
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <div class="help-container">
        <h2>Need Help?</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Describe your issue..." required></textarea>
            </div>
            <button type="submit" name="submit_help" class="btn btn-primary">Submit</button>
        </form>

        <div class="help-list">
            <h3>Your Help Requests</h3>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="help-item">
                        <h4><?php echo htmlspecialchars($row['subject']); ?></h4>
                        <p><?php echo htmlspecialchars($row['message']); ?></p>
                        <div class="date"><?php echo date("F j, Y, g:i a", strtotime($row['submitted_at'])); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No help requests submitted yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>

</html>
