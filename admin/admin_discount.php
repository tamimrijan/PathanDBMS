<?php
session_start();
require_once "dbconnection.php"; // Include your database connection file

// Check if user is an admin
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>
            alert('Access Denied!');
            window.location.href='index.php';
          </script>";
    exit;
}

// Handle discount addition
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Discount
    if (isset($_POST['add_discount'])) {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $discount_percentage = trim($_POST['discount_percentage']);
        $valid_from = trim($_POST['valid_from']);
        $valid_to = trim($_POST['valid_to']);

        if (!empty($title) && !empty($description) && !empty($discount_percentage) && !empty($valid_from) && !empty($valid_to)) {
            $query = "INSERT INTO discounts (title, description, discount_percentage, valid_from, valid_to) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dbcon->prepare($query);
            $stmt->bind_param("ssdss", $title, $description, $discount_percentage, $valid_from, $valid_to);
            if ($stmt->execute()) {
                $success = "Discount added successfully!";
            } else {
                $error = "Error adding discount.";
            }
            $stmt->close();
        } else {
            $error = "All fields are required.";
        }
    }

    // Delete Discount
    if (isset($_POST['delete_discount'])) {
        $discount_id = intval($_POST['discount_id']);
        $query = "DELETE FROM discounts WHERE id = ?";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("i", $discount_id);
        if ($stmt->execute()) {
            $success = "Discount deleted successfully!";
        } else {
            $error = "Error deleting discount.";
        }
        $stmt->close();
    }
}

// Fetch all discounts
$query = "SELECT * FROM discounts ORDER BY valid_from ASC";
$result = $dbcon->query($query);

$dbcon->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Discounts</title>
    <link rel="icon" type="image/x-icon" href="upre011.png">
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
            padding: 60px 0 0;
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

        .admin-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 800px;
            margin: 20px auto;
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

        .btn-primary, .btn-danger {
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

        .btn-danger:hover {
            background-color: #e74c3c;
            color: white;
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

        .discount-list {
            margin-top: 30px;
        }

        .discount-item {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .discount-item h4 {
            margin: 0 0 10px;
            color: #333;
        }

        .discount-item p {
            margin: 0;
            color: #555;
        }

        .discount-item .validity {
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
            position: auto;
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

    <div class="admin-container">
        <div>
        <h5>
            <a href="dashboard.php" style="float: left; margin-left:20px;">Back to Dashboard</a>
        </h5>
        <h5>
            <a href="logout.php" style="float: right; margin-right:20px;">Log Out</a>
        </h5>
    </div>
        <h2>Admin Panel - Manage Discounts</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Add Discount Form -->
        <form method="POST" action="">
            <h3>Add New Discount</h3>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Discount title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Discount details" required></textarea>
            </div>
            <div class="form-group">
                <label for="discount_percentage">Discount Percentage:</label>
                <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" placeholder="e.g., 10.50" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="valid_from">Valid From:</label>
                <input type="date" name="valid_from" id="valid_from" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="valid_to">Valid To:</label>
                <input type="date" name="valid_to" id="valid_to" class="form-control" required>
            </div>
            <button type="submit" name="add_discount" class="btn btn-primary">Add Discount</button>
        </form>

        <!-- Discount List -->
        <div class="discount-list">
            <h3>Existing Discounts</h3>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="discount-item">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p><strong>Discount: </strong><?php echo htmlspecialchars($row['discount_percentage']); ?>%</p>
                        <div class="validity">
                            Valid From: <?php echo htmlspecialchars($row['valid_from']); ?> - 
                            Valid To: <?php echo htmlspecialchars($row['valid_to']); ?>
                        </div>
                        <form method="POST" action="" style="margin-top: 10px;">
                            <input type="hidden" name="discount_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_discount" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No discounts available.</p>
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
