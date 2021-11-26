<?php
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov="Prehlad surovin";
include "widgets/navbar.php";
$conn = '';
include "config.php";

if ($_GET["id"]!="")
{
    $query = "SELECT nazov, alergeny,  FROM recept ORDER BY id ASC WHERE ";
    //TODO vyskusat si prikaz
    //TODO cena
}

else
{
    header($_SERVER["SERVER_PROTOCOL"]." 400 Bad request");
}
?>