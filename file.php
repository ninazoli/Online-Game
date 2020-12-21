<?php

$date = date('Y-m-d');
$filename = $date."-click.log";
$buttonID = $_POST['buttonID'];
$datetime = date('m-d-Y H:i:s');
$userIP = $_SERVER['HTTP_CLIENT_IP'];
$handle = "";

$row = $userIP."/".$datetime."/".$buttonID.",";

if (file_exists($filename)) {​​​​
 $handle = fopen($filename, "r");
 fwrite($handle, $row."\n");
}​​​​ else {​​​​
  $handle = fopen($filename, 'w');
  fwrite($handle, $row."\n");
}​​​​
fclose($handle);
 
$mysqli = new mysqli("localhost","root","root","test");
 
// Check connection
if ($mysqli -> connect_errno) {​​​​
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}​​​​
 
$mysqli -> query("INSERT INTO register_log (user_ip, datetime, button_id) VALUES ($userIP, $datetime, $buttonID)");
 
$mysqli -> close();
 

return true;
 
?>