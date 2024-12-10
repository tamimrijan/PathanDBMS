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

// Handle approval or rejection
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $refund_id = intval($_POST['refund_id']);
    $action = $_POST['action']; // 'approve' or 'reject'

    if (!empty($refund_id) && ($action === 'approve' || $action === 'reject')) {
        $new_status = $action === 'approve' ? 'Approved' : 'Rejected';

        $query = "UPDATE refund_requests SET status = ? WHERE id = ?";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("si", $new_status, $refund_id);

        if ($stmt->execute()) {
            $success = "Refund request successfully " . strtolower($new_status) . "!";
        } else {
            $error = "Error updating refund request.";
        }
        $stmt->close();
    } else {
        $error = "Invalid request.";
    }
}

// Fetch all refund requests
$query = "SELECT rr.*, u.name AS user_name, c.date AS courier_date, c.weight AS courier_weight
          FROM refund_requests rr
          JOIN users u ON rr.u_id = u.u_id
          JOIN courier c ON rr.c_id = c.c_id
          ORDER BY rr.created_at DESC";
$result = $dbcon->query($query);

$dbcon->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Approval - Admin Panel</title>
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
            max-width: 900px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-reject:hover {
            background-color: #c82333;
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

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e74c3c;
            color: white;
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

    <div class="admin-container">
        <div>
        <h5>
            <a href="dashboard.php" style="float: left; margin-left:20px;">Back to Dashboard</a>
        </h5>
        <h5>
            <a href="logout.php" style="float: right; margin-right:20px;">Log Out</a>
        </h5>
    </div>
        <h2>Refund Approval</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Courier Date</th>
                    <th>Weight</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['courier_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['courier_weight']); ?> kg</td>
                            <td><?php echo htmlspecialchars($row['reason']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <?php if ($row['status'] === 'Pending'): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="refund_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="approve" class="btn btn-approve">Approve</button>
                                    </form>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="refund_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="reject" class="btn btn-reject">Reject</button>
                                    </form>
                                <?php else: ?>
                                    <span><?php echo htmlspecialchars($row['status']); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No refund requests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>

</html>
