<?php 
	$host = 'localhost';
	$dbname = 'diplomdb';
	$user = 'root';
	$pass = '1234';

	try {
		$connect = mysqli_connect($host, $user, $pass, $dbname);
	} catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
?>