<?php
$conn="";
include "config.php";
$nazovSuboru="Prehlad receptov";
include "widgets/header.php";

$bc_nazov = "Prehlad receptov";
include "widgets/navbar.php";
?>

<div class="container-fluid">
    <h2>Zoznam receptov</h2>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <a href="new_recept.php" class="btn btn-primary"><i class="fas fa-plus"></i>Vytvorit novy recept</a>
        </div>
    </div>
</div>
<div
