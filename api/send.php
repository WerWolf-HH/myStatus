<?php
// Authentification
session_start();                  // Start Session for Sessionmanagement
include("../mysql.php");          // Include MySQL Access and Functions

if(!empty($_GET)){
    $user_name = strval($_GET['name']);
    $user_status = intval($_GET['status']);

    // Chekf if Username already exists

    $query = $dbConn->prepare('SELECT `name` FROM `status` WHERE
    name = :user_name');

    // Run SQL Statement with given Values
    $query->execute(array(
        'user_name' => $user_name));
    if ($query->rowCount() >=1){
        // Result is 1 or more (so Data already exists)
        // Prepare SQL Statement to Update existing User
        $query = $dbConn->prepare('UPDATE `status` SET
        status = :user_status WHERE
        name = :user_name');

        // Run SQL Statement with given Values
        if(!$query->execute(array(
            'user_name' => $user_name,
            'user_status' => $user_status))){
                $jsonResponse = new stdClass();
                $jsonResponse->status = "error";
                $jsonResponse->message = "Update error";
                $jsonResponse = json_encode($jsonResponse);
                echo $jsonResponse;
                die();
        }
    }else{
        // Result is 0, Name doesnt exists
        // Prepare SQL Statement to create a new User
        $query = $dbConn->prepare('INSERT INTO `status` SET
        name = :user_name,
        status = :user_status');

        // Run SQL Statement with given Values
        if(!$query->execute(array(
            'user_name' => $user_name,
            'user_status' => $user_status))){
                $jsonResponse = new stdClass();
                $jsonResponse->status = "error";
                $jsonResponse->message = "Creating Entry error";
                $jsonResponse = json_encode($jsonResponse);
                echo $jsonResponse;
                die();
        }
    }
    $jsonResponse = new stdClass();
    $jsonResponse->status = "success";
    $jsonResponse->message = "Status setted";
    $jsonResponse = json_encode($jsonResponse);
    echo $jsonResponse;
    die();
}else{
$jsonResponse = new stdClass();
$jsonResponse->status = "error";
$jsonResponse->message = "No GET Values provided";
$jsonResponse = json_encode($jsonResponse);
echo $jsonResponse;
die();

}

?>