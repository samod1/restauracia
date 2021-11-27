<?php
$conn="";
include "configDb.php";

if ($_GET["zmazat"] == "ano" && $_GET["id"] != "") {

    $id = $_GET["id"];
    $query = "DELETE FROM tbl_suroviny WHERE id_suroviny=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: tbl_suroviny.php');
}
mysqli_close($conn);