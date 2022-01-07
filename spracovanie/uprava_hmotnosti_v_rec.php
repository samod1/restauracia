<?php
$conn = "";
include "../configDb.php";
if (isset($_POST["edit"]))
{
    $hmotnost = $_POST["hmotnost"];
    $id = $_POST["idRecSur"];
    $idReceptu = $_POST["idRec"];

    $query = "UPDATE tbl_suroviny_k_receptu SET mnozstvo = ? WHERE id_rec_sur = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'si', $hmotnost, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../detail_jedla.php?id=$idReceptu");
    mysqli_close($conn);
}
