<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../admin/login.php');
    exit;
}

// Include database connection
include('../dbconnection.php');

// Handle date decrement and status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_date'])) {
    $c_id = $_POST['c_id'];

    // Fetch the current date of the courier
    $query = "SELECT `date` FROM `courier` WHERE `c_id` = ?";
    $stmt = $dbcon->prepare($query);
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $courier = $result->fetch_assoc();

    if ($courier) {
        $current_date = $courier['date'];
        $new_date = date('Y-m-d', strtotime($current_date . ' -1 day')); // Decrement the date by 1 day

        // Update the date in the database
        $update_query = "UPDATE `courier` SET `date` = ? WHERE `c_id` = ?";
        $stmt = $dbcon->prepare($update_query);
        $stmt->bind_param("si", $new_date, $c_id);

        if ($stmt->execute()) {
            // Check if the new date is in the past to update the status
            if (strtotime($new_date) < strtotime(date('Y-m-d'))) {
                $status_update_query = "UPDATE `courier_status` SET `status` = 'Delivered' WHERE `c_id` = ?";
                $status_stmt = $dbcon->prepare($status_update_query);
                $status_stmt->bind_param("i", $c_id);
                $status_stmt->execute();
            }
            $message = "Date updated successfully!";
        } else {
            $message = "Failed to update the date.";
        }
    } else {
        $message = "Courier not found.";
    }
}

// Fetch all couriers
$query = "
    SELECT c.c_id, c.sname, c.rname, c.date, cs.status 
    FROM courier c 
    LEFT JOIN courier_status cs ON c.c_id = cs.c_id 
    ORDER BY c.date ASC";
$result = $dbcon->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courier Dates</title>
    <link rel="icon" type="image/x-icon" href="upre011.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('../font/Li Ador Noirrit SemiBold.ttf');
        }

        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            margin: 0;
            color: #f5f6fa;
        }

        .container {
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

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: indigo;
            color: white;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 0, 0, 0.2);
        }

        td {
            font-size: 16px;
            color: black;
        }

        .btn-update {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-update:hover {
            background-color: black;
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
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-danger">Back to Dashboard</a>
                <a href="logout.php" class="btn btn-danger">Log Out</a>
            </div>
            <h2>Manage Courier Dates</h2>
        </div>
    </header>

    <div class="container">
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Courier ID</th>
                    <th>Sender Name</th>
                    <th>Receiver Name</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['c_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['sname']); ?></td>
                            <td><?php echo htmlspecialchars($row['rname']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                    <button type="submit" name="update_date" class="btn-update">Delivery Done</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No couriers found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
    </div>
</body>
</html>
