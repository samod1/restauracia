<?php
$conn="";
include "configDb.php";

if ($_GET["zmazat"]=="ano" && $_GET["id"] != " ")
{
    $query = "DELETE FROM tbl_suroviny_k_receptu WHERE id_rec_sur=?";
    $stmtSuroviny = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmtSuroviny, $query);
    mysqli_stmt_bind_param($stmtSuroviny, "i", $_GET["id"]);
    mysqli_stmt_execute($stmtSuroviny);
    mysqli_stmt_close($stmtSuroviny);
}