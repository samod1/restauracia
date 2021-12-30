<?php
$stranka = "kategorie";
include "config.php";
$conn ="";
include "configDb.php";
$nazovSuboru="Kategorie";
include "widgets/header.php";
$bc_nazov="Kategorie";
include "widgets/navbar.php";
?>

<h3>Kategorie</h3>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
</ul>
