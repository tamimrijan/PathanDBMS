<?php
// Connect to the database
$servername = "localhost";
$username = "pathanbd_courierdb"; // Replace with your DB username
$password = "gameloft101"; // Replace with your DB password
$dbname = "pathanbd_courierdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to update delivery status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courier_id = $_POST['courier_id'];
    $update_status_query = "UPDATE payments SET status='Paid' WHERE id=?";
    $stmt = $conn->prepare($update_status_query);
    $stmt->bind_param("i", $courier_id);

    if ($stmt->execute()) {
        echo "<script>alert('Delivery status updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update status.');</script>";
    }
    $stmt->close();
}

// Fetch courier data
$query = "SELECT c.c_id, c.sname, c.rname, c.saddress, c.raddress, c.weight, p.status 
          FROM courier c
          LEFT JOIN payments p ON c.billno = p.billno
          ORDER BY c.date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Options</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Delivery Options</h1>
    <table>
        <thead>
            <tr>
                <th>Courier ID</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Sender Address</th>
                <th>Receiver Address</th>
                <th>Weight</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['c_id']}</td>
                        <td>{$row['sname']}</td>
                        <td>{$row['rname']}</td>
                        <td>{$row['saddress']}</td>
                        <td>{$row['raddress']}</td>
                        <td>{$row['weight']} kg</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form method='post' action=''>
                                <input type='hidden' name='courier_id' value='{$row['c_id']}'>
                                <button type='submit'>Mark as Delivered</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No couriers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
