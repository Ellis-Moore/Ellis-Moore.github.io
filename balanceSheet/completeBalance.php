<?php
    /* Collects all information on property */
    /* VARIABLES */
    /* 
    $request            object  encoded JSON post
    $JSONobj            object  decoded $request
    $sql                string  contains sql statement 
    $result             query   sends $sql to database 
    $gettransactions    array   Collects $results and is encoded back to html
    */
	header("Content-Type: application/json; charset=UTF-8");
    require_once 'config.php';


    // Capture the input
	$request = file_get_contents('php://input');
	
	// Decode the JSON so it is useable in PHP
	$JSONobj = json_decode($request);


     
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

    // build SQL DML Statement
	
        $sql = "SELECT *
                FROM `transactions` 'properties'
                WHERE propertyID LIKE '". $JSONobj->ID ."'";
	
    
    // Execute the query and respond accordingly

	$result = $conn->query($sql);
	$gettransactions = array();
	$gettransactions = $result->fetch_all(MYSQL_ASSOC);

	echo json_encode($gettransactions);
    
	// close the connection
	$conn->close();

?>