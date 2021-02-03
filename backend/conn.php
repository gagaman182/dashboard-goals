<?php


// // home
// $servername = "localhost";
// $username = "root";
// $password = "123456789";
// $dbname = "goals";
// $port = "3306";

// 5.1
// $servername = "localhost";
// $username = "root";
// $password = "1234";
// $dbname = "goals";
// $port = "3306";



// // takis 3
$servername = "61.19.25.207";
$username = "takis3";
$password = "skho@00866";
$dbname = "goals";
$port = "3306";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $conn -> set_charset("utf8");

?>