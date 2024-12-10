<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    echo "";
} else {
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Data Information</title>
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

        a {
            color: #e74c3c;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: black;
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
            <h2>Search Data Information</h2>
        </div>
    </header>

    <div class="container">
        <!-- Search Form -->
        <form method="GET" action="">
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" class="form-control" name="sname" placeholder="Sender Name" value="<?php echo isset($_GET['sname']) ? $_GET['sname'] : ''; ?>">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="rname" placeholder="Receiver Name" value="<?php echo isset($_GET['rname']) ? $_GET['rname'] : ''; ?>">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="semail" placeholder="Sender Email" value="<?php echo isset($_GET['semail']) ? $_GET['semail'] : ''; ?>">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Items Image</th>
                    <th>Sender Name</th>
                    <th>Receiver Name</th>
                    <th>Sender Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../dbconnection.php');

                // Search parameters
                $sname = isset($_GET['sname']) ? $_GET['sname'] : '';
                $rname = isset($_GET['rname']) ? $_GET['rname'] : '';
                $semail = isset($_GET['semail']) ? $_GET['semail'] : '';

                // Base query
                $qryd = "SELECT * FROM `courier` WHERE 1";

                // Add conditions based on search input
                if (!empty($sname)) {
                    $qryd .= " AND `sname` LIKE '%$sname%'";
                }
                if (!empty($rname)) {
                    $qryd .= " AND `rname` LIKE '%$rname%'";
                }
                if (!empty($semail)) {
                    $qryd .= " AND `semail` LIKE '%$semail%'";
                }

                // Execute the query
                $run = mysqli_query($dbcon, $qryd);

                if (mysqli_num_rows($run) < 1) {
                    echo "<tr><td colspan='6'>No record found..</td></tr>";
                } else {
                    $count = 0;
                    while ($data = mysqli_fetch_assoc($run)) {
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" style="max-width: 100px;"/> </td>
                            <td><?php echo $data['sname']; ?></td>
                            <td><?php echo $data['rname']; ?></td>
                            <td><?php echo $data['semail']; ?></td>
                            <td><a href="datadeleted.php?bb=<?php echo $data['billno']; ?>">Delete</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
    </div>
</body>
</html>