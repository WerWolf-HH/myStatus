<?php
// Authentification
session_start();                  // Start Session for Sessionmanagement
date_default_timezone_set('Europe/Berlin');
include("../mysql.php");          // Include MySQL Access and Functions
$jsonResponse = new stdClass();

// Fetch Data

$query_1 = $dbConn->prepare('SELECT * FROM `status` WHERE (`status`=1) AND (`timestamp` BETWEEN NOW() - INTERVAL 20 MINUTE AND NOW());');
$query_1->execute();
$ammount_1 = $query_1->rowCount();

$query_2 = $dbConn->prepare('SELECT * FROM `status` WHERE (`status`=2) AND (`timestamp` BETWEEN NOW() - INTERVAL 20 MINUTE AND NOW());');
$query_2->execute();
$ammount_2 = $query_2->rowCount();

$query_3 = $dbConn->prepare('SELECT * FROM `status` WHERE (`status`=3) AND (`timestamp` BETWEEN NOW() - INTERVAL 20 MINUTE AND NOW());');
$query_3->execute();
$ammount_3 = $query_3->rowCount();

$query_4 = $dbConn->prepare('DELETE FROM `status` WHERE `timestamp` < NOW() - INTERVAL 20 MINUTE;');
$query_4->execute();

$jsonResponse->status = "success";
$jsonResponse->time = date("d.m.Y H:i:s \U\h\\r", time());
$jsonResponse->ammount_1 = $ammount_1;
$jsonResponse->ammount_2 = $ammount_2;
$jsonResponse->ammount_3 = $ammount_3;

$ammount_1_user = array();
foreach ($query_1 as $row){
    array_push($ammount_1_user, $row['name']);
}
$jsonResponse->ammount_1_user = $ammount_1_user;

$ammount_2_user = array();
foreach ($query_2 as $row){
    array_push($ammount_2_user, $row['name']);
}
$jsonResponse->ammount_2_user = $ammount_2_user;

$ammount_3_user = array();
foreach ($query_3 as $row){
    array_push($ammount_3_user, $row['name']);
}
$jsonResponse->ammount_3_user = $ammount_3_user;

$jsonResponse = json_encode($jsonResponse);
echo $jsonResponse;

?>