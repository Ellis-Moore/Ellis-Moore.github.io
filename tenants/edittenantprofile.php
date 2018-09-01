<?php
    /*
    VARIABLES 
    
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
	
	// Capture the input
	$request = file_get_contents('php://input');
	
	// Decode the JSON so it is useable in PHP
	$JSONobj = json_decode($request);
	

    $servername = "localhost";
	$username = "naylors_user";
	$password = "shaun";
	$DB = "naylors";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $DB);
	
	// build SQL DML Statement
	$sql = "UPDATE tenants 
            SET tenantForename = '". $JSONobj->Forename ."' , tenantSurname = '". $JSONobj->Surname ."', tenantPhone = '". $JSONobj->Phone ."' , tenantEmail = '". $JSONobj->Email ."' , dateOfMove = '". $JSONobj->Date ."' 
			WHERE tenantID = '". $JSONobj->ID ."'";

    // UPDATE tenants 

	
	// Execute the query and respond accordingly
	if ($conn->query($sql) === TRUE) {
		echo json_encode("Record editted successfully");
	}
	else {
		echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}
	
	// close the connection
	$conn->close();
	
?>