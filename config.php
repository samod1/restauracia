<?php
$server = "db.dw082.nameserver.sk";
$user = "restauracia_1";
$pass = "Test1234";
$db = "restauracia";

$conn = mysqli_connect($server,$user,$pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>