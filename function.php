<?php

$date = date('Y-m-d');
$filename = $date."-click.log";
$buttonID = $_POST['buttonID'];
$datetime = date('Y-m-d H:i:s');


$userIP = "";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $userIP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $userIP = $_SERVER['REMOTE_ADDR'];
}
$row = $userIP."/".$datetime."/".$buttonID.",";

if (file_exists("logs/".$filename)){
    $existing = fopen("logs/".$filename, 'a');
    fwrite($existing, $row."\n");  
    fclose($existing);  
}else{
    $created = fopen("logs/".$filename, "w");
    fwrite($created, $row."\n");  
    fclose($created);
}


$conn = mysqli_connect("127.0.0.1","root","","casino");

// Check connection

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$conn -> query("INSERT INTO register_log (user_ip, date_time, button_id) VALUES ('$userIP', '$datetime', '$buttonID')");

mysqli_close($conn);

echo $buttonID;


?>