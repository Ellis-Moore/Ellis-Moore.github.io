<?php
    // Launch config and secureLogin
    require_once '../secureLogin.php';
    require_once '../config.php';
  
    // Capture the input
	$request = file_get_contents('php://input');
	
	// Decode the JSON so it is useable in PHP
	$JSONobj = json_decode($request);
    
    // IF request is for all users
    if(isset($JSONobj->allUsers)){
        echo json_encode($user->allUsers());
    };
    
    // IF request is an ID 
    if(isset($JSONobj->ID)){
        $ID = $JSONobj->ID;
        echo json_encode($user->removeUser($ID));
    }
    
    // IF a username was sent 
    if(isset($JSONobj->Username)){
        // Separte out object
        $name     = $JSONobj->Name;
        $username = $JSONobj->Username;
        $password = $JSONobj->Password;

        // Verify success
        if($user->newUser($name, $username, $password)){
                echo json_encode("Record added successfully");
            }else{
                echo json_encode("Error");
        }
    }
    
?>