<?php
$conn = "";
include "../configDb.php";
if ($_POST["edit"]=="yes")
{
    //definovanie premennych
    $idReceptu  = $_POST["idReceptu"];
    $nazovReceptu = $_POST["nazovReceptu"];
    $postupReceptu = $_POST["postupReceptu"];
    $alergeny = $_POST["alergeny"];
    $cenaJedla = $_POST["cenaJedla"];

    //UPDATE querina

    $query = "UPDATE tbl_recept SET nazov_receptu=?,postup_receptu=?,alergeny=?,cena_jedla=? WHERE id_receptu=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'sssii', $nazovReceptu, $postupReceptu,$alergeny,$cenaJedla,$idReceptu);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../zoznam_receptov.php");
    mysqli_close($conn);


}

