<?php
$conn ="";
include "config.php";
$nazovSuboru="Sklad";
include "widgets/header.php";
$bc_nazov="Sklad";
include "widgets/navbar.php";

?>
<div class="container-fluid">
    <h3>Modul skladovych zasob</h3>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="Objednavky" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Objednavky</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sklad" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Skladove zasoby</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="Objednavky">
            <div class="container-fluid">
                <br>
                <h4>Objednavky</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cislo objednavky</th>
                            <th>Datum dodania</th>
                            <th>Datum splatnosti</th>
                            <th>Variabilny symbol</th>
                            <th>Celkova cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0000000</td>
                            <td>25.11.2021</td>
                            <td>31.12.2021</td>
                            <td>5465145615</td>
                            <td>150$</td>
                        </tr>

                        <tr>
                            <td>0000000</td>
                            <td>25.11.2021</td>
                            <td>31.12.2021</td>
                            <td>5465145615</td>
                            <td>150$</td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="sklad">
            <div class="container-fluid">
                <h4>Skladove zasoby</h4>
                <!-- TODO zaanalyzovat -->
                <table class="table table-striped">
                    <tbody>
                        <tr>fsakdbkfjjd</tr>
                    </tbody>
                </table>
            </div>

        </div>
    <table class=""></table>
</div>
