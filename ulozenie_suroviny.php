<?php
$conn="";
require_once "config.php";

if ($_POST["save"] == "yes") {

    $id = 0;
    $id_rec = $_POST["id_rec"];
    $id_suroviny= $_POST["surovina"];
    $mnozstvo = $_POST["mnozstvo"];
    $jednotka = $_POST["jednotka"];

    echo $id_rec .",". $id_suroviny .",". $mnozstvo .",". $jednotka;

    //console.log($id." ".$id_rec." ". $id_suroviny. " ". $mnozstvo. " ". $jednotka);


    $query = "INSERT INTO restauracia.suroviny_k_receptu (id_rec_sur, id_sur, id_rec, mnozstvo, jednotka) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'iiisi', $id,$id_suroviny, $id_receptu, $mnozstvo, $jednotka);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_commit($conn);
    //header("Location: zoznam_receptov.php");
}
mysqli_close($conn);