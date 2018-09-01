<?php
    // Grabs landlord profile from database 
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
    $landlordName       array       results put into an array
    
    */
    require_once '../secureLogin.php';
    require_once '../config.php';

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
    
	
    $sql = "SELECT landlordName 
            FROM landlords
            WHERE landlordID = ". $JSONobj->ID ."";


   

    // Execute the query and respond accordingly
    

	$result = $conn->query($sql);
  
	$landlordName = $result->fetch_all(MYSQL_ASSOC);
        
    echo json_encode($landlordName);

    
    

?>