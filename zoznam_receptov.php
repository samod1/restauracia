<?php
include "config.php";
$conn="";
include "configDb.php";
$nazovSuboru= $lang["RecList"];
include "widgets/header.php";

$bc_nazov = $lang["RecList"];
include "widgets/navbar.php";

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
    <h3><?php echo $lang["RecList"]?></h3>
</div>
        <div class="col-4">
            <a href="new_recept.php" class="btn btn-primary"><?php echo $lang["newRec"]?></a>
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
