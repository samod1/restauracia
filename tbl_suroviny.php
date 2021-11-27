<?php
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov="Prehlad surovin";
include "widgets/navbar.php";
$conn = '';
include "configDb.php";
?>
<div class="container-fluid">
<div class="row">
    <form class="form-group" method="post">
        <div class="col-6">
            <label>Kategoria suroviny</label>
            <select name="kategoria" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option>Maso</option>
                <option>Ryby</option>
                <option>Cukor</option>
                <option>Hovadzina</option>
                <option>kuracie stehna</option>
                <option>Kuracie prsia</option>
            </select>
        </div>
        <div class="col-2">
            <input type="submit" value="Vyhladaj" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>

<?php
if ($_POST["kategoria"]!="")
{
    //TODO zobraz vsetky zaznamy
}
else
{
    //TODO zobraz zaznamy iba danej kategorie
}
?>
</div>