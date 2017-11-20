<?php
    $host = 'localhost';
    $dbname = 'gestionpannes';
    $username = 'root';
    $password = '';
	
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage()
	);
	}
?>