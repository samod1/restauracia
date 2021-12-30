<?php
$conn="";
include "../configDb.php";

if (isset($_POST["priradit"]) && $_POST["save"] == "yes") {

    $id = 0;
    $id_rec = $_POST["id_rec"];
    $id_suroviny= $_POST["surovina"];
    $mnozstvo = $_POST["mnozstvo"];


    $query = "INSERT INTO tbl_suroviny_k_receptu (id_rec_sur, id_sur, id_rec, mnozstvo) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'iiis', $id,$id_suroviny, $id_rec, $mnozstvo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_commit($conn);
    header("Location: ../detail_jedla.php?id=$id_rec");
}
mysqli_close($conn);
?>