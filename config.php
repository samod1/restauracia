<?php
   session_start();

    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "sk";
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
        if ($_GET['lang'] == "sk")
            $_SESSION['lang'] = "sk";
        else if ($_GET['lang'] == "cz")
            $_SESSION['lang'] = "cz";
    }

    require_once "langs/" . $_SESSION['lang'] . ".php";

/*
 * dgfdsvdfsgdfgf
$server = "db.dw082.nameserver.sk";
$user = "restauracia_1";
$pass = "Test1234";
$db = "restauracia";

$conn = mysqli_connect($server,$user,$pass,$db);

if (!$conn) {
    die("Spojenie neuspesne: " . mysqli_connect_error());
}
echo "Pripojenie prebehlo uspesne.";*/
?>