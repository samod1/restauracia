<?php
include "config.php";
$conn="";
include "configDb.php";

$nazovSuboru= $lang["HOME"];
  include "widgets/header.php";
  $bc_nazov = $lang["HOME"];
  include "widgets/navbar.php";

?>
<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-4">
            <table class="table table-stripped">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" style="text-align: center"><h5><?php echo $lang["STATISTICS"]?></h5></th>
                    </tr>
                </thead>

                <tr>
                    <th><?php echo $lang["DAY"]?></th>
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

                        if($_SESSION['lang'] == "sk") {
                            echo $dniSK[date('N')];
                        }
                        else
                        {
                            echo $dniSK[date('N')];
                        }
                        ?></td>
                </tr>
                <tr>
                    <th><?php echo $lang["MENU_COUNT"]?></th>
                    <td><a href="jedalny_listok.php">2</a></td>

                </tr>
                <tr>
                    <th><?php echo $lang["RECIEPE_COUNT"]?></th>
                    <td><?php
                        $query="SELECT id_receptu FROM tbl_recept";
                        $result= mysqli_query($conn,$query);
                        $pocetRiadkov=mysqli_num_rows($result);
                        if ($pocetRiadkov==0)
                        {
                            echo "0";
                        }
                        else
                        {
                        echo  "<a href='zoznam_receptov.php'>".$pocetRiadkov.'</a>';
                        }?></td>
                </tr>
                <tr>
                    <th><?php echo $lang["GUEST_COUNT"]?></th>

                    <td>250</td>
                </tr>
            </table>
        </div>
        <div class="col"></div>
    </div>
    <h3><?php echo $lang["TODAYS_MENU"]?></h3>
    <table class="table table-stripped">
        <tbody>
            <tr>
                <th colspan="2" class="table-active" style="text-align: center">
                    <?php echo $dniCZ[date('N')]; ?>
                </th>
            </tr>
            <tr>
                <th>Polivka</th>
                <td>Kulajda</td>
            </tr>
            <tr>
                <th>Menu 1</th>
                <td>Kureci ryzecek s bramborovou kasi</td>
            </tr>
            <tr>
                <th>Menu 2</th>
                <td>Kureci ryzecek s bramborovou kasi</td>
            </tr>
            <tr>
                <th>Menu 3</th>
                <td>Kureci ryzecek s bramborovou kasi</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include "widgets/footer.php";
?>

