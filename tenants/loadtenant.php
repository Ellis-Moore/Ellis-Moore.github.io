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
    $sql                string      cross table SQL statment 
    $result             list        results from executing sql
    $tenant             array       contains results in Array
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
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

    // build SQL DML Statement
	
        $sql = "SELECT *
                FROM tenants properties
                WHERE tenantID = ". $JSONobj->id ."";

  
    // Execute the query and respond accordingly

	$result = $conn->query($sql);
	$loadtenant = array();
    $loadtenant = $result->fetch_all(MYSQL_ASSOC);
    echo json_encode($loadtenant);
    
	// close the connection
	$conn->close();

?>