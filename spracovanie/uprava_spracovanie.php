<?php
$conn="";
require "../configDb.php";

if (isset($_POST["uprav"]) && $_POST["surovina"]=="yes")
{
    $nazov = $_POST["nazovSuroviny"];
    $kategoria = $_POST["kategoria"];
    $jednotka = $_POST["jednotka"];
    $popis = $_POST["popis"];
    $dodavatel = $_POST["dodavatel"];
    $katalogove = $_POST["katalogove_cislo"];
    $netto = $_POST["netto"];
    $brutto = $_POST["brutto"];
    $id = $_POST["idSuroviny"];

    echo $nazov;
    echo $kategoria;
    echo $jednotka;
    echo $popis;
    echo $dodavatel;
    echo $katalogove;
    echo $netto;
    echo $brutto;
    echo $id;

    $queryEdit="UPDATE tbl_suroviny SET nazov_suroviny = ?, kategoria_suroviny = ?,jednotka = ?,popis_suroviny = ?,dodavatel = ?,katalogove_cislo = ?, hmotnost_netto = ?, hmotnost_brutto = ? WHERE id_suroviny =?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$queryEdit);
    mysqli_stmt_bind_param($stmt,"siisssssi",$nazov,$kategoria,$jednotka,$popis,$dodavatel,$katalogove,$netto,$brutto,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_commit($conn);
    header("Refresh:3; url=../tbl_suroviny.php", true, 200);
}