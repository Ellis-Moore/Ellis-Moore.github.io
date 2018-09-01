<?php
	header("Content-Type: application/json; charset=UTF-8");
	
	// Capture the input
	$request = file_get_contents('php://input');
	
	// Decode the JSON so it is useable in PHP
	$JSONobj = json_decode($request);
	
    // Create variables to be used when connecting to database
    $servername = "localhost";
	$username = "naylors_user";
	$password = "shaun";
	$DB = "naylors";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $DB);
	
	// build SQL DML Statement
	$sql = "UPDATE properties
            SET addressLine1 = '". $JSONobj->addressLine1 ."' , addressLine2 = '". $JSONobj->addressLine2 ."', addressLine3 = '". $JSONobj->addressLine3 ."' , postCode = '". $JSONobj->postCode ."' , tenantID = '". $JSONobj->tenantID ."' 
			WHERE propertyID = '". $JSONobj->ID ."'";

   
	
	
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