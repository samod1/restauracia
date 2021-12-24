<?php
$conn = "";
include"../configDb.php";

if ($_POST["send"] == "yes") {

$id = 0;
$query = "INSERT INTO tbl_suroviny (id_suroviny,nazov_suroviny,kategoria_suroviny,mnozstvo_sklad,jednotka,popis_suroviny,
                          dodavatel,katalogove_cislo,hmotnost_brutto,hmotnost_netto) VALUES (?,?,?,?,?,?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 'isiiisssii', $id, $_POST["nazovSuroviny"],$_POST["katSuroviny"],$_POST["mnozstvo"],$_POST["jednotka"],
    $_POST["popis"],$_POST["dodavatel"],$_POST["katCislo"],$_POST["brutto"],$_POST["netto"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: ../tbl_suroviny.php");
}
?>
