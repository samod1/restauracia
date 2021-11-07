<?php
$conn="";
$nazovSuboru="Editacia suroviny";
$bcNazov="Editacia suroviny";
include "widgets/header.php";

if ($_GET["id"] !=="")
{
    $idSuroviny = $_GET["id"];
    $query="SELECT nazov_suroviny,kategoria_suroviny FROM restauracia.tbl_suroviny WHERE id_suroviny".$idSuroviny;
    $result="";
}