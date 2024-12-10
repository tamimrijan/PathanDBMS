<?php
// Start the session
session_start();

// Database connection (replace with your database credentials)
$host = 'localhost';
$dbname = 'pathanbd_courierdb'; // replace with your DB name
$username = 'pathanbd_courierdb'; // replace with your DB username
$password = 'gameloft101'; // replace with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the input is not empty
    if (!empty($username) && !empty($password)) {
        // Prepare and execute the query to check the user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) { // Assuming password is hashed
                // Successful login
                $_SESSION['uid'] = $user['id']; // Store user ID in session
                $_SESSION['username'] = $user['username']; // Optional: store username

                // Redirect to the dashboard
                header('Location: admin/dashboard.php');
                exit();
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "No user found with that username.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>