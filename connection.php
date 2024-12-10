<?php

$conn = "";

try {
	$servername = "localhost";
	$dbname = "pathanbd_courierdb";
	$username = "pathanbd_courierdb";
	$password = "gameloft101";

	$conn = new PDO(
		"mysql:host=$servername; dbname=pathanbd_courierdb",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>
