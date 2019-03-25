<?php

session_start();

$path = dirname(__FILE__); 

//echo $path;
$script = $_SERVER['SCRIPT_NAME'];
$page = @substr(end(explode('/', $script)), 0, -4);

echo $page;

//$mysqli = new mysqli("localhost", "root", "", "formstack1");
//$result = $mysqli->query("SELECT 'Hello MySQL User!' AS _message FROM DUAL");
//$row = $result->fetch_assoc();
//echo htmlentities($row['_message']);



include("{$path}/inc/user.inc.php");

//$_SESSION['uid'] = 0;

?>


