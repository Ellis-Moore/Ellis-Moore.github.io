<?php
    // Fetch all properties from database 
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
    $result             list        SQL result
    $property       array       results put into an array
    */
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
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

    // build SQL DML Statement

    // IF the object is an empty string 
	if ($JSONobj->postcode == "") {
        $sql = "SELECT *
                FROM `properties`
                WHERE 1";
        
    }else{

         $sql = "SELECT *
			     FROM `properties`
			     WHERE postCode LIKE '". $JSONobj->postcode ."%'";
    

    }


    // Collect results from query 
	$result = $conn->query($sql);
    // Create array to store results
	$property = array();
    // Put results into array
	$property = $result->fetch_all(MYSQL_ASSOC);
    // Send array back
	echo json_encode($property);
    
	// close the connection
	$conn->close();

?>