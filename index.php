<?php
$conn="";
include "config.php";

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
                    <td><?php
                        $dniSK= [
                           1=>'Pondelok',
                           2=>'Utorok',
                           3=>'Streda',
                           4=>'Štvrtok',
                           5=>'Piatok',
                           6=>'Sobota',
                           7=>'Nedeľa'];
                        $dniCZ= [
                           1=>'Pondělí',
                           2=>'Úterý',
                           3=>'Středa',
                           4=>'Čtvrtek',
                           5=>'Pátek',
                           6=>'Sobota',
                           7=>'Neděle'];
                        echo $dniCZ[date('N')];
                        ?></td>
                </tr>
                <tr>
                    <th>Pocet vytvorenych menu</th>
                    <td><a href="jedalny_listok.php">2</a></td>

                </tr>
                <tr>
                    <th>Pocet receptu</th>
                    <td><?php
                        $query="SELECT id FROM restauracia.recept";
                        $result= mysqli_query($conn,$query);
                        $pocetRiadkov=mysqli_num_rows($result);
                        echo $pocetRiadkov;
                        ?></td>
                </tr>
                <tr>
                    <th>Pocet hostu tento tyzden</th>
                    <td>250</td>
                </tr>
            </table>
        </div>
        <div class="col"></div>
    </div>
    <h3>Menu na tenhle den</h3>
    <table class="table table-stripped">
        <tbody>
            <tr><th colspan="2" class="table-active" style="text-align: center">Pondeli MOCK</th></tr>
            <tr>
                <th>Polivka</th>
                <td>Kulajda</td>
            </tr>
            <tr>
                <th>Menu 1</th>
                <td>Kureci ryzecek s bramborovou kasi</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include "widgets/footer.php";
?>

