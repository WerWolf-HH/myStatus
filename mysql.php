<?php
// Settings for this AGT MANAGER Installation

// Database Access
$agtmanager_dburl = "db:3306";
$agtmanager_dbuser = "root";
$agtmanager_dbpass = "root";
$agtmanager_dbname = "mystatus";
$agtmanager_dbcharset = "utf8mb4";


// ================  NO CHANGES AFTER THIS LINE ================


// New PDO for MySQL Connection

$dbConn = new PDO('mysql:dbname='.$agtmanager_dbname.';host='.$agtmanager_dburl.';charset='.$agtmanager_dbcharset.'', $agtmanager_dbuser, $agtmanager_dbpass);
$dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>