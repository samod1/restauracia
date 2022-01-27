<?php
$conn = "";
include "../configDb.php";

if ($conn !=" " && isset($_POST["potvrdenie"]) && $_POST["Send"]== "yes")
{
    $id = 0;
    $query = "INSERT INTO tbl_prijemka (ID_objednavky, Cislo_objednavky, Datum_dorucenia, Datum_splatnosti, Celkova_cena, 
                          Variabilny_symbol) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init ($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_bind_param($stmt,"isssss", $id, $_POST["cisloObjednavky"],
        $_POST["datDorucenia"],$_POST["datSplatnosti"],$_POST["celkovaCena"],$_POST["varSymbol"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../sklad.php");
}
mysqli_close($conn);
?>