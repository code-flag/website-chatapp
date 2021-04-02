<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbn = 'chatpeer';

$con = mysqli_connect($servername,$username,$password,$dbn) ;

try {
    $conn = new PDO("mysql:host=$servername;dbname=chatpeer", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>