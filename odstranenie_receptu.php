<?php
$conn="";
include "configDb.php";

if ($_GET["zmazat"] == "ano" && $_GET["id"] != "") {

    $querySuroviny = "DELETE FROM suroviny_k_receptu WHERE id_rec=?";
    $stmtSuroviny = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmtSuroviny, $querySuroviny);
    mysqli_stmt_bind_param($stmtSuroviny, "i", $id);
    mysqli_stmt_execute($stmtSuroviny);
    mysqli_stmt_close($stmtSuroviny);

    $id = $_GET["id"];
    $query = "DELETE FROM recept WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    }
mysqli_close($conn);
header('Location: zoznam_receptov.php');