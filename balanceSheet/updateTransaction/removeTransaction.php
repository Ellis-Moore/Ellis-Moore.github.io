<?php
    /* removes transaction on database */
    /* VARIABLES */
    /*
    $servername         string      name of the server to connect to 
    $username           string      username required for the server
    $password           string      password for the server 
    $DB                 string      name of the database 
    $conn               function    Connects to the server
    $request            object      encoded request from html
    $JSONobj            object      decoded $request
    $sql                string      SQL statment
    */
	header("Content-Type: application/json; charset=UTF-8");
	$servername = "localhost";
	$username = "naylors_user";
	$password = "shaun";
	$DB = "naylors";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $DB);

	// Capture the input
	$request = file_get_contents('php://input');
	
	// Decode the JSON so it is useable in PHP
	$JSONobj = json_decode($request);
	


	// build SQL DML Statement
	$sql = "DELETE FROM `transactions` WHERE transactionID = '". $JSONobj->ID ."'";

    
	
	
	// Execute the query and respond accordingly
	if ($conn->query($sql) === TRUE) {
		echo json_encode("Record removed successfully");
	}
	else {
		echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}
	
	// close the connection
	$conn->close();
	
?>