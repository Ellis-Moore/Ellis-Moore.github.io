<?php
    /* Updates transaction on database dependent on given variables */
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
    $result             list        SQL result
    */

	header("Content-Type: application/json; charset=UTF-8");
    require_once '../secureLogin.php';
    require_once '../config.php';
    
    // Create connection
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
    
    // Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

    // build SQL DML Statement on condition
    
    if(isset($JSONobj->Rent)){
        
        $sql = "UPDATE `transactions` 
                SET `rent`=". $JSONobj->Rent ." 
                WHERE transactionID=". $JSONobj->ID ."";
       
        // Execute the query and respond accordingly

        $result = $conn->query($sql);
        echo $result;

	  
    
    }
        
    if(isset($JSONobj->Date)){
        
        $sql = "UPDATE `transactions` 
                SET `date`=". $JSONobj->Date ." 
                WHERE transactionID=". $JSONobj->ID ."";
        
        // Execute the query and respond accordingly

        $result = $conn->query($sql);
        echo $result;
    
    }
        
    if(isset($JSONobj->Bill)){
        
        $sql = "UPDATE `transactions` 
                SET `bill`=". $JSONobj->Bill ." 
                WHERE transactionID=". $JSONobj->ID ."";
        
        // Execute the query and respond accordingly

        $result = $conn->query($sql);
        echo $result;
    
    }
   
    
        
    
	// close the connection
	$conn->close();

?>