<?php

function connect() {
	$host = 'localhost';
	$user = 'rkern3';
	$pwd = 'rkern3';
	$dbname = 'GroceryDB';
	$conn=@mysqli_connect($host,$user,$pwd,$dbname);
	return $conn;
}

function close($conn) {
	mysqli_close($conn);
}

?>
