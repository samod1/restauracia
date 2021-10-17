<?php
$nazovSuboru="Vitejte";
  include "widgets/header.php";
  $bc_nazov = "Domov";
  include "widgets/navbar.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-4">
            <table class="table table-stripped">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" style="text-align: center"><h5>Statistiky</h5></th>
                    </tr>
                </thead>

                <tr>
                    <th>Den</th>
                    <td><?php $mydate=getdate(date("U"));
                            echo "$mydate[weekday]"?></td>
                </tr>
                <tr>
                    <th>Pocet vytvorenych menu</th>
                    <td><a href="jedalny_listok.php">2</a></td>

                </tr>
                <tr>
                    <th>Pocet hostu tento tyzden</th>
                    <td>250</td>
                </tr>
            </table>
        </div>
        <div class="col"></div>
    </div>
    <h3>Menu na aktualny tyzden</h3>
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

