<?php
session_start();
if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header('location: ../login.php');
}

// Manually connect to the database
$hostname = "localhost"; // Your database server hostname
$username = "pathanbd_courierdb"; // Your database username
$password = "gameloft101"; // Your database password
$database = "pathanbd_courierdb"; // Your database name
// Create connection
$dbcon = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$dbcon) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Courier</title>
    <style>
        /* Font Face Integration */
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }

        body {
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif; /* Apply the custom font */
            background-image: url('bg.jpg'); /* Add the background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .container {
            width: 90%;
            margin: 50px auto;
            overflow-x: auto;
            flex-grow: 1;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            min-width: 600px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        
        th {
            background-color: #e60000; /* Red */
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #ddd;
        }
        
        th:first-child, td:first-child {
            text-align: center;
        }

        img {
            max-width: 100px;
            border-radius: 8px;
        }

        a {
            color: #e60000;
            text-decoration: none;
            margin: 0 5px;
            font-weight: bold;
        }

        a:hover {
            color: #ff6666;
        }

        /* Footer Styles */
        .footer {
            background-color: #1c1c1c; /* Dark background */
            color: #ffffff; /* White text */
            text-align: center;
            padding: 15px 0;
            font-family: 'Li Ador Noirrit SemiBold', Arial, sans-serif;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        .footer a {
            color: #e60000; /* Red links */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ff6666;
        }
        h2 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
     <h2>ট্র্যাক করুন</h2>
    <table>
        <tr>
            <th>No.</th>
            <th>Item's Image</th>
            <th>Sender Name</th>
            <th>Receiver Name</th>
            <th>Receiver Email</th>
            <th>Action</th>
        </tr>

        <?php
        $email = $_SESSION['emm'];

        $qryy = "SELECT * FROM `courier` WHERE `semail`='$email'";
        $run = mysqli_query($dbcon, $qryy);

        if (mysqli_num_rows($run) < 1) {
            echo "<tr><td colspan='6' style='text-align:center;'>No record found..</td></tr>";
        } else {
            $count = 0;
            while ($data = mysqli_fetch_assoc($run)) {
                $count++;
        ?>
                <tr align="center">
                    <td><?php echo $count; ?></td>
                    <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" /></td>
                    <td><?php echo $data['sname']; ?></td>
                    <td><?php echo $data['rname']; ?></td>
                    <td><?php echo $data['remail']; ?></td>
                    <td>
                        <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>">Edit</a> ||
                        <a href="deletecourier.php?bb=<?php echo $data['billno']; ?>">Delete</a> ||
                        <a href="status.php?sidd=<?php echo $data['c_id']; ?>">Check Status</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</div>

<div class="footer">
    <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
    <p>✨ Made By Tamim And Farzana</p>
    <a href="../mailme.html">Contact Us</a>
</div>

</body>
</html>