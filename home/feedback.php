<?php
session_start();
require_once "dbconnection.php"; // Include database connection

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

// Handle feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $feedback = trim($_POST['feedback']);

    if (!empty($feedback)) {
        $query = "INSERT INTO feedback (u_id, feedback) VALUES (?, ?)";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("is", $user_id, $feedback);
        if ($stmt->execute()) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Error submitting feedback.";
        }
        $stmt->close();
    } else {
        $error = "Feedback cannot be empty.";
    }
}

// Fetch all feedback
$query = "SELECT f.feedback, f.submitted_at, u.name 
          FROM feedback f 
          JOIN users u ON f.u_id = u.u_id 
          ORDER BY f.submitted_at DESC";
$result = $dbcon->query($query);

$dbcon->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
    background-image: url('bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

        .feedback-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #e74c3c;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: black;
        }

        .feedback-list {
            margin-top: 30px;
        }

        .feedback-item {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .feedback-item h4 {
            margin: 0 0 10px;
            color: #333;
        }

        .feedback-item p {
            margin: 0;
            color: #555;
        }

        .feedback-item .date {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
        @font-face {
    font-family: 'Li Ador Noirrit SemiBold';
    src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
}
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

    <div class="feedback-container">
        <h2>Submit Your Feedback</h2>

        <?php if ($error): ?>
            <p class="text-danger text-center"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="text-success text-center"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="4" placeholder="Write your feedback here..." required></textarea>
            </div>
            <button type="submit" name="submit_feedback" class="btn btn-primary">Submit Feedback</button>
        </form>

        <div class="feedback-list">
            <h3>Recent Feedback</h3>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="feedback-item">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                        <p><?php echo htmlspecialchars($row['feedback']); ?></p>
                        <div class="date"><?php echo date("F j, Y, g:i a", strtotime($row['submitted_at'])); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No feedback available.</p>
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
