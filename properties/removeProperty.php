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
    $sqlcross           string      Cross table SQL statment
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
	
	// build SQL DML Statements


    // Cross table delete to completely remove records
    $sqlcross = "DELETE 
                FROM properties, transactions 
                WHERE properties.propertyID = '". $JSONobj->ID ."'
                AND properties.propertyID = transactions.propertyID";

	// Single table delete incase profile was not linked to tenant
	$sql = "DELETE 
            FROM properties 
            WHERE propertyID = '". $JSONobj->ID ."'";
            

	
	// Execute the query and respond accordingly
	if ($conn->query($sqlcross) === TRUE) {
		echo json_encode("Property and payments removed successfully");
	}

	if($conn->query($sql) === TRUE){
			echo json_encode("Property removed successfully");
		}
	else {
		echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}
	
	// close the connection
	$conn->close();
	
?>