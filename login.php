<?php
$nazovSuboru = "Prihlaste sa";
include "widgets/header.php";
?>
<div class="container">

    <div style="background-color: white;" class="jumbotron">
        <h1 style="text-align: center;">doRest</h1>
    </div>

    <div class="jumbotron  d-flex justify-content-center">
        <div class="jumbotron">
            <h2>Prihlaste sa</h2>
        </div>
        <br>
        <br>
        <form class="form-group" method="post" action="spracovanie/overenie_hesla.php">
            <label>Prihlasovacie meno</label>
            <input type="text" class="form-control form-control-lg" name="meno">
            <br>
            <label>Heslo</label>
            <input name="heslo" type="password" class="form-control form-control-lg">
            <br>
            <input name="prihlasit_sa" class="btn btn-primary btn-lg btn-block" type="submit" value="Prihlaste sa">
        </form>
    </div>
</div>