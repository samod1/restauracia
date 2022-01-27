<?php
$conn ="";
include "config.php";
include "configDb.php";
$nazovSuboru="Prijemka";
include "widgets/header.php";
$bc_nazov="Prijemka";
$stranka = "sklad";
include "widgets/navbar.php";
?>
<h3>Príjemka</h3>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<div class="container-fluid">
    <form method="post" class="form-group" action="spracovanie/vytvorenie_prijemky.php">
        <label>Cislo objednavky</label>
        <input class="form-control" type="text" name="cisloObjednavky" required autofocus>

        <label>Variabilny symbol</label>
        <input class="form-control" type="text" name="varSymbol" required autofocus>

        <label>Datum dorucenia</label>
        <input class="form-control" type="date" name="datDorucenia" required autofocus>

        <label>Datum splatnosti</label>
        <input class="form-control" type="date" name="datSplatnosti" required autofocus>

        <label>Celkova Cena</label>
        <input class="form-control" type="text" name="celkovaCena" required autofocus>

        <label>Prijmovy doklad / Faktura</label>
        <input class="form-control" type="file">
        <input type="hidden" name="Send" value="yes">
        <br>
        <input type="submit" name="potvrdenie" class="btn btn-primary btn-lg btn-block" value="Vytvorit prijemku">

    </form>
</div>
<?php
include "widgets/footer.php";
mysqli_close($conn);
?>