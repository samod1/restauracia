<?php
$conn="";
include "config.php";
$nazovSuboru="Prehlad receptov";
include "widgets/header.php";

$bc_nazov = "Prehlad receptov";
include "widgets/navbar.php";

if ($_GET["zmazat"] == "ano" && $_GET["id"] != "") {

    $id = $_GET["id"];
    $query = "DELETE FROM restauracia.recept WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
    <h3>Zoznam receptov</h3>
</div>
        <div class="col-4">
            <a href="new_recept.php" class="btn btn-primary"><i class="fa fa-plus"></i> Vytvorit novy recept</a>
        </div>
    </div>
<?php
include "widgets/tabulka_recept.php";
?>
</div>
<?php
mysqli_close($conn);
include "widgets/footer.php";
?>
