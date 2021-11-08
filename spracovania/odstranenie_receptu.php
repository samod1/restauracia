<?php
$conn="";
include "../config.php";

if ($_GET["zmazat"] == "ano" && $_GET["id"] != "") {

    $id = $_GET["id"];
    $query = "DELETE FROM restauracia.recept WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../zoznam_receptov.php");
}