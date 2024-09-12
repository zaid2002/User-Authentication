<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registerlogin";

$conn = mysqli_connect(hostname: $servername,username: $username,password: $password,database: $dbname);

if(!$conn){
    die ("Error");
}


?>