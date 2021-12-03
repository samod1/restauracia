<?php
include "config.php";
$nazovSuboru = "Jidelny listek";
include "widgets/header.php";
$bc_nazov = "Jidelny listek";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <h3>Jidelny listek</h3>
    <h4>Datum od - datum do</h4>
    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
       aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-calculator"></i> Pocet osob</a>
    <br>
    <div class="row">
        <br>
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <form method="post" class="form-group">
                        <label>Pocet hostu</label>
                        <input class="form-control" type="number" name="pocetHostu">
                        <br>
                        <input type="submit" class="btn btn-primary btn-lg" value="Prepocitat">
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
        <div class="col">
            <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Tlacit menu</a>
        </div>
    </div>
    <h5>Podavane jidla</h5>
    <table class="table table-stripped">
        <tbody>
        <tr><th colspan="2" class="table-active" style="text-align: center">Pondeli</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>

        <tr><th colspan="2" class="table-active" style="text-align: center">Utery</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        <tr><th colspan="2" class="table-active" style="text-align: center">Streda</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        <tr><th colspan="2" class="table-active" style="text-align: center">Ctvrtek</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        <tr><th colspan="2" class="table-active" style="text-align: center">Patek</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        <tr><th colspan="2" class="table-active" style="text-align: center">Sobota</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        <tr><th colspan="2" class="table-active" style="text-align: center">Nedele</th></tr>
        <tr>
            <th>Polivka</th>
            <td>Kulajda</td>
        </tr>
        <tr>
            <th>Hlavni jidlo:</th>
            <td> Kureci rezen s brambory a salatem</td>
        </tr>
        </tbody>
    </table>
</div>
<?php
include "widgets/footer.php";
?>
