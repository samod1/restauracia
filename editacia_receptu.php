<?php
$nazovSuboru="Editacia receptu";
include "widgets/header.php";

$bc_nazov="Editacia receptu";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <h3>Editacia receptu</h3>

    <form class="form-group">
        <label>Nazov receptu</label>
        <input class="form-control form-control-lg" type="text">
        <br>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Ulozit">
    </form>
</div>
<?php
include "widgets/footer.php";
?>