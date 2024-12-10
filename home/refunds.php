<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "pathanbd_courierdb";
$password = "gameloft101";
$dbname = "pathanbd_courierdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's ID
$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    echo "You need to log in to access this page.";
    exit;
}

// Fetch user's courier history
$sql_courier = "SELECT * FROM courier WHERE u_id = ?";
$stmt_courier = $conn->prepare($sql_courier);
$stmt_courier->bind_param("i", $user_id);
$stmt_courier->execute();
$result_courier = $stmt_courier->get_result();

$couriers = [];
while ($row = $result_courier->fetch_assoc()) {
    $couriers[] = $row;
}

// Handle refund requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_id = $_POST['c_id'] ?? null;
    $reason = $_POST['reason'] ?? '';

    if ($c_id && $reason) {
        $sql_refund = "INSERT INTO refund_requests (u_id, c_id, reason) VALUES (?, ?, ?)";
        $stmt_refund = $conn->prepare($sql_refund);
        $stmt_refund->bind_param("iis", $user_id, $c_id, $reason);

        if ($stmt_refund->execute()) {
            echo "Refund request submitted successfully!";
        } else {
            echo "Error submitting refund request: " . $conn->error;
        }
    } else {
        echo "Please select a courier and provide a reason for the refund.";
    }
}

// Fetch user's refund requests
$sql_refund_history = "SELECT rr.*, c.date, c.weight FROM refund_requests rr
                       JOIN courier c ON rr.c_id = c.c_id
                       WHERE rr.u_id = ?";
$stmt_refund_history = $conn->prepare($sql_refund_history);
$stmt_refund_history->bind_param("i", $user_id);
$stmt_refund_history->execute();
$result_refund_history = $stmt_refund_history->get_result();

$refund_requests = [];
while ($row = $result_refund_history->fetch_assoc()) {
    $refund_requests[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Requests - Pathan</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            width: 100%;
            text-align: center;
            padding: 20px 0;
        }

        .refund-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
        }

        h1, h2 {
            color: #e74c3c;
            text-align: center;
        }

        label {
            color: #333;
            font-weight: bold;
        }

        select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        button {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 30px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: black;
            color: white;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th {
            background-color: #e74c3c;
            color: white;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        .footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
            margin-top: auto; /* Push footer to the bottom */
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #e74c3c;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <div class="refund-container">
        <h1>Request a Refund</h1>

        <h2>My Couriers</h2>
        <?php if (!empty($couriers)) : ?>
            <form method="POST" action="refunds.php">
                <label for="c_id">Select Courier:</label>
                <select id="c_id" name="c_id" required>
                    <option value="">--Select Courier--</option>
                    <?php foreach ($couriers as $courier) : ?>
                        <option value="<?php echo $courier['c_id']; ?>">
                            <?php echo "Courier ID: " . $courier['c_id'] . " | Date: " . $courier['date']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="reason">Reason for Refund:</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>

                <button type="submit">Submit Refund Request</button>
            </form>
        <?php else : ?>
            <p>No couriers found.</p>
        <?php endif; ?>

        <h2>My Refund Requests</h2>
        <?php if (!empty($refund_requests)) : ?>
            <table>
                <tr>
                    <th>Request ID</th>
                    <th>Courier ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Weight</th>
                    <th>Submitted At</th>
                </tr>
                <?php foreach ($refund_requests as $request) : ?>
                    <tr>
                        <td><?php echo $request['id']; ?></td>
                        <td><?php echo $request['c_id']; ?></td>
                        <td><?php echo htmlspecialchars($request['reason']); ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td><?php echo $request['date']; ?></td>
                        <td><?php echo $request['weight']; ?> kg</td>
                        <td><?php echo $request['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No refund requests found.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>

</html>

