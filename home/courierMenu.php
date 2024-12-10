<?php
// Start session and enable error reporting
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$dbcon = mysqli_connect('localhost', 'pathanbd_courierdb', 'gameloft101', 'pathanbd_courierdb');

// Check connection
if (!$dbcon) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Verify user session
if (!isset($_SESSION['uid'])) {
    header('Location: ../index.php');
    exit();
}

// Retrieve user details
$email = $_SESSION['emm'];
$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অর্ডার Place করুন</title>
    <link rel="icon" type="image/x-icon" href="../favicon01.png">
    <style>
        /* Font Face Integration */
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        /* General Styling */
        :root {
            --primary-color: #ff1a1a;
            --secondary-color: #1c1c1c;
            --bg-color: #1c1c1c;
            --input-bg: #f9f9f9;
            --border-color: #cccccc;
            --hover-color: #ff4d4d;
        }

        body {
            background-image: url('bg.jpg'); /* Use background image */
            background-size: cover; /* Ensure it covers the full area */
            background-position: center center; /* Center the image */
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif; /* Use the custom font */
            color: var(--secondary-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        form {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6); /* Black shadow */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        table {
            width: 100%;
            border-spacing: 15px;
        }

        th {
            text-align: center;
            font-size: 1.2rem;
            padding: 10px;
            background-color: var(--primary-color);
            color: #ffffff;
            border-radius: 5px;
        }

        td {
            text-align: center; /* Center-align all text */
            padding: 10px;
        }

        input[type="text"], input[type="number"], input[type="date"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            background-color: var(--input-bg);
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: var(--hover-color);
        }

        .footer {
            margin-top: auto;
            width: 100%;
            background-color: var(--bg-color);
            color: #ffffff;
            text-align: center;
            padding: 15px 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            color: var(--hover-color);
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <form action="courierMenu.php" method="POST" enctype="multipart/form-data">
        <h1>অর্ডার করুন </h1>
        <table>
            <tr>
                <th colspan="2">Sender Details</th>
                <th colspan="2">Receiver Details</th>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="sname" placeholder="Sender Full Name" required></td>
                <td>Name:</td>
                <td><input type="text" name="rname" placeholder="Receiver Full Name" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="semail" value="<?php echo htmlspecialchars($email); ?>" readonly></td>
                <td>Email:</td>
                <td><input type="text" name="remail" placeholder="Receiver Email" required></td>
            </tr>
            <tr>
                <td>Phone No.:</td>
                <td><input type="number" name="sphone" placeholder="Sender Phone Number" required></td>
                <td>Phone No.:</td>
                <td><input type="number" name="rphone" placeholder="Receiver Phone Number" required></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="saddress" placeholder="Sender Address" required></td>
                <td>Address:</td>
                <td><input type="text" name="raddress" placeholder="Receiver Address" required></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>Weight (kg):</td>
                <td><input type="number" name="wgt" placeholder="Weight in KG" required></td>
                <td>Payment ID:</td>
                <td><input type="number" name="billno" placeholder="Transaction Number" required></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly></td>
                <td>Item Image:</td>
                <td><input type="file" name="simg"></td>
            </tr>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <input type="submit" name="submit" value="Place Order">
        </div>
        <div style="text-align: center; margin-top: 20px;">
    <button type="button" onclick="window.location.href='payment.php';">Go to Payment</button>
</div>

    </form>
    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>
</html>

<?php
// Handle form submission
if (isset($_POST['submit'])) {
    // Retrieve form data
    $sname = $_POST['sname'];
    $rname = $_POST['rname'];
    $semail = $_POST['semail'];
    $remail = $_POST['remail'];
    $sphone = $_POST['sphone'];
    $rphone = $_POST['rphone'];
    $sadd = $_POST['saddress'];
    $radd = $_POST['raddress'];
    $wgt = $_POST['wgt'];
    $billn = $_POST['billno'];
    $newDate = date('Y-m-d', strtotime($_POST['date']));
    $imagenam = $_FILES['simg']['name'];
    $tempnam = $_FILES['simg']['tmp_name'];

    // Move uploaded file
    if (!empty($imagenam)) {
        $uploadDir = '../dbimages/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        move_uploaded_file($tempnam, $uploadDir . $imagenam);
    } else {
        $imagenam = null; // Handle case where no file was uploaded
    }

    // Insert data into database
    $qry = "INSERT INTO `courier` (`sname`, `rname`, `semail`, `remail`, `sphone`, `rphone`, `saddress`, `raddress`, `weight`, `billno`, `image`, `date`, `u_id`) 
            VALUES ('$sname', '$rname', '$semail', '$remail', '$sphone', '$rphone', '$sadd', '$radd', '$wgt', '$billn', '$imagenam', '$newDate', '$uid')";
    $run = mysqli_query($dbcon, $qry);

    if ($run) {
        echo "<script>
            alert('Order Placed Successfully :)');
            window.open('courierMenu.php', '_self');
        </script>";
    } else {
        echo "Error: " . mysqli_error($dbcon);
    }
}
?>