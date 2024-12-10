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

// Fetch couriers and payment statuses associated with the user
$sql_courier = "SELECT c.c_id, c.billno, c.date, c.weight, 
                       IFNULL(p.status, 'Unpaid') AS status, 
                       IFNULL(p.amount, 0) AS amount, 
                       p.payment_date 
                FROM courier c 
                LEFT JOIN payments p ON c.billno = p.billno 
                WHERE c.u_id = ?";
$stmt_courier = $conn->prepare($sql_courier);
$stmt_courier->bind_param("i", $user_id);
$stmt_courier->execute();
$result_courier = $stmt_courier->get_result();

$couriers = [];
while ($row = $result_courier->fetch_assoc()) {
    $couriers[] = $row;
}

// Handle payment marking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $billno = $_POST['billno'] ?? null;
    $amount = $_POST['amount'] ?? null;

    if ($billno && $amount) {
        // Check if payment already exists
        $sql_check = "SELECT * FROM payments WHERE billno = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i", $billno);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Update existing payment
            $sql_payment = "UPDATE payments 
                            SET status = 'Paid', payment_date = NOW(), amount = ? 
                            WHERE billno = ?";
            $stmt_payment = $conn->prepare($sql_payment);
            $stmt_payment->bind_param("di", $amount, $billno);
        } else {
            // Insert new payment
            $sql_payment = "INSERT INTO payments (billno, status, amount, payment_date) 
                            VALUES (?, 'Paid', ?, NOW())";
            $stmt_payment = $conn->prepare($sql_payment);
            $stmt_payment->bind_param("id", $billno, $amount);
        }

        if ($stmt_payment->execute()) {
            echo "<script>alert('Payment marked as completed!'); window.open('../home/payment.php', '_self');</script>";
            // Refresh to show the updated payment status
            header("Location: payment.php");
            exit;
        } else {
            echo "Error updating payment status: " . $conn->error;
        }
    } else {
        echo "Please select a valid courier and provide the amount.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            color: #000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2 {
            color: #ff1a1a;
            text-align: center;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #ff1a1a;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 100px;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        label, select, input, button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        button {
            padding: 10px;
            background-color: #ff1a1a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e60000;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            background-color: #1c1c1c;
            color: white;
            padding: 10px 0;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #ff1a1a;
            text-decoration: none;
        }

        .footer a:hover {
            color: #e60000;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <h1>Payment Status</h1>

    <?php if (!empty($couriers)) : ?>
        <table>
            <tr>
                <th>Courier ID</th>
                <th>Trix ID (Billno)</th>
                <th>Date</th>
                <th>Weight (kg)</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
            </tr>
            <?php foreach ($couriers as $courier) : ?>
                <tr>
                    <td><?php echo $courier['c_id']; ?></td>
                    <td><?php echo $courier['billno']; ?></td>
                    <td><?php echo $courier['date']; ?></td>
                    <td><?php echo $courier['weight']; ?></td>
                    <td><?php echo $courier['amount']; ?></td>
                    <td><?php echo $courier['status']; ?></td>
                    <td><?php echo $courier['payment_date'] ?? 'Not Paid'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p style="text-align: center; color: #ff1a1a;">No couriers found.</p>
    <?php endif; ?>

    <h2>Mark Payment as Done</h2>
    <form method="POST" action="payment.php">
        <label for="billno">Select Trix ID (Billno):</label>
        <select id="billno" name="billno" required>
            <option value="">--Select Billno--</option>
            <?php foreach ($couriers as $courier) : ?>
                <?php if ($courier['status'] === 'Unpaid') : ?>
                    <option value="<?php echo $courier['billno']; ?>">
                        <?php echo "Trix ID: " . $courier['billno'] . " | Amount: " . $courier['amount']; ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label for="amount">Enter Payment Amount:</label>
        <input type="text" id="amount" name="amount" required>

        <button type="submit">Mark as Paid</button>
    </form>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
    </div>
</body>
</html>
