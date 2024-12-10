<?php

include_once('connection.php');

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$stmt = $conn->prepare("SELECT * FROM adminlogin WHERE username = :username AND password = :password");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();
	$user = $stmt->fetch(); // Use fetch() to get a single matching user
	
	if ($user) {
		header("Location: ../admin/dashboard.php");
		exit();
	} else {
		echo "<script language='javascript'>";
		echo "alert('WRONG INFORMATION');";
		echo "window.location.href='adminlogin.php';"; // Redirect to the login page
		echo "</script>";
		exit();
	}
}
?>
