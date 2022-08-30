<?php 

$server = "localhost";
$user = "db86894";
$pass = "Vtndry671";
$database = "86894_database";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>