<?php
    /* Collects all transactions from database */

    /*  VARIABLES */
    /*
    $servername         string      name of the server to connect to 
    $username           string      username required for the server
    $password           string      password for the server 
    $DB                 string      name of the database 
    $conn               function    Connects to the server
    $request            object      encoded request from html
    $JSONobj            object      decoded $request
    $sql                string      SQL statment 
    $result             list        SQL result
    $gettransactions    array       results put into an array
    */
	header("Content-Type: application/json; charset=UTF-8");
    require_once '../secureLogin.php';
    require_once '../config.php';

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
	
        $sql = "SELECT *
                FROM `transactions` 
                WHERE propertyID LIKE '". $JSONobj->ID ."'
                ORDER BY date";
	
    
    // Execute the query and respond accordingly

	$result = $conn->query($sql);
	$gettransactions = array();
	$gettransactions = $result->fetch_all(MYSQL_ASSOC);

	echo json_encode($gettransactions);
    
	// close the connection
	$conn->close();

?>