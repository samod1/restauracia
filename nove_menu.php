<?php

include "config.php";
$conn="";
include "configDb.php";
$stranka = "listky";
$nazovSuboru="Novy jedalny listok";
$bc_nazov="Novy jidelny listek";

include "configDb.php";
include "widgets/header.php";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h3>Novy jidelny listek</h3>
        </div>
    </div>
    <form method="post" class="form-group">
        <div class="row">
            <div class="col-6">
                <label>Datum od</label>
                <input class="form-control form-control-lg" type="date" name="od">
            </div>

            <div class="col-6">
                <label>Datum do</label>
                <input class="form-control form-control-lg" type="date" name="do">
            </div>
        </div>
        <label>Pocet osob</label>
        <input class="form-control form-control-lg" type="number" name="pocetOsob">

        <br>
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Vytvorit">
        <input type="hidden" name="ulozit" value="yes">
    </form>
</div>

<?php
if ($_POST["pocetOsob"]!="" && $_POST["do"]!="" && $_POST["od"] !="" && isset($_POST["ulozit"]) != "yes") {

    $id = 0;
    $query = "INSERT INTO tbl_menu (id_menu,datum_od,datum_do,pocet_hosti) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'issi', $id, $_POST["od"],$_POST["do"],$_POST["pocetOsob"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

else
{
    ?><div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Niesu vyplnene vsetky polia formulara.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
header("Location:priradenie_jedal.php");
include "widgets/footer.php";
?>
