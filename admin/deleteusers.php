<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect unauthorized users to the login page
    header('Location: ../admin/login.php');
    exit;
}

// Include database connection
include('../dbconnection.php');

// Initialize search query
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = trim($_GET['search']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showing All Users</title>
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

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-container input {
            border-radius: 30px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 16px;
            width: 70%;
            outline: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-container button {
            margin-left: 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: black;
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
            <h2>Showing All Users</h2>
            <div class="search-container">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by name or email" value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch users from the database with search functionality
                $qry = "SELECT * FROM `users`";
                if (!empty($search_query)) {
                    $qry .= " WHERE `name` LIKE '%" . mysqli_real_escape_string($dbcon, $search_query) . "%' 
                              OR `email` LIKE '%" . mysqli_real_escape_string($dbcon, $search_query) . "%'";
                }
                $run = mysqli_query($dbcon, $qry);

                if (mysqli_num_rows($run) < 1) {
                    echo "<tr><td colspan='4' align='center'>No users found.</td></tr>";
                } else {
                    $count = 0;
                    while ($data = mysqli_fetch_assoc($run)) {
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td><a href="usersdeleted.php?emm=<?php echo urlencode($data['email']); ?>">Delete User</a></td>
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
