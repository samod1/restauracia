<?php
include "config.php";
$conn ="";
include "configDb.php";
$nazovSuboru="Priradenie surovin";
include "widgets/header.php";
$bc_nazov="Priradenie surovin";
include "widgets/navbar.php";
?>
<div class="jumbotron-fluid">

<?php

if ($_GET["id"] != "") {

    $queryNazov= "SELECT nazov_receptu FROM tbl_recept WHERE id_receptu=". $_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
        {
            echo "<h3>". $lang["Hprir"]." ".$rowNazov["nazov_receptu"]."</h3>";
            }?>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#pridaneSuroviny" aria-expanded="false" aria-controls="multiCollapseExample2"><?php echo $lang["btnPrir1"];?></button>
            </div>
            <div class="col">
                <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#kategorieSurovin" aria-expanded="false" aria-controls="multiCollapseExample2"><?php echo $lang["btnPrir2"];?></button>
            </div>
        </div>


    <div class="collapse multi-collapse" id="pridaneSuroviny">
        <h4><?php echo $lang["SurInRec"];?></h4>
            <?php
            $querySur="SELECT nazov_suroviny ,kategoria_suroviny,mnozstvo, skratka  FROM tbl_suroviny_k_receptu INNER JOIN tbl_suroviny ON tbl_suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny INNER JOIN enum_jednotka ON tbl_suroviny.jednotka = enum_jednotka.id_jednotky WHERE id_rec = ".$_GET["id"]." ORDER BY kategoria_suroviny ASC ";
            $resultSur= mysqli_query($conn, $querySur);
            $pocetRiadkov = mysqli_num_rows($resultSur);
            if (!$resultSur) {
                echo "Error: Neda sa vykonat prikaz SQL: " . $querySur . ".<br>" . PHP_EOL;
                exit;
            }
            if ($pocetRiadkov == 0) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Pre tento recept sa nenasli ziadne suroviny.</strong>
                </div>";
            }
            else
            {?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $lang["nazSur"];?></th>
                    <th><?php echo $lang["amount"];?></th>
                    <th><?php echo $lang["action"];?></th>
                </tr>
                </thead>
                <tbody>
        <?php
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            {
            ?>
            <tr>
                <td><?php echo $rowSur["nazov_suroviny"]?></td>
                <td><?php echo $rowSur["mnozstvo"], " ", $rowSur["skratka"]?></td>
                <td><a href="#" class="btn btn-danger"><?php echo $lang["del"];?></td>

            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php }?>
        <br>
    </div>

    <br>

    <div class="collapse multi-collapse" id="kategorieSurovin">
        <form method="post" class="form-group">
            <div class="row">
                <div class="col">
                    <?php
                        $queryKat="SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                        $resultKat= mysqli_query($conn,$queryKat);
                    ?>
                        <label><?php echo $lang["btnPrir2"];?></label>
                        <select class="form-control form-control-lg" name="kategoria">
                            <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                            {
                                ?>
                            <option value="<?php echo $rowKat["id_kategorie"];?>"><?php echo $rowKat["nazov_kategorie"];?></option>
                                <?php
                            }
                            ?>
                        </select>

                </div>
                <div class="col">
                    <label></label>
                    <input name="submit" type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $lang["showSur"];?>">
                </div>
            </div>
        </form>
    </div>
        <?php
        if (isset($_POST["submit"]))
        {
            $query = "SELECT id_suroviny,nazov_suroviny,kategoria_suroviny FROM tbl_suroviny WHERE kategoria_suroviny =" .$_POST["kategoria"] ;  //uspodiadaj ASC od najmensieho po najvacsi
            $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
        ?>


            <form class="form-group" method="post" action="spracovanie/ulozenie_suroviny.php">
                <input type="hidden" name="id_rec" value="<?php echo $_GET["id"];?>">

                <label for="surovina"><?php echo $lang["recSurPl"];?></label>
                <select id="surovina" name="surovina" class="form-control form-control-lg">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row["id_suroviny"]?>"><?php echo $row["nazov_suroviny"]?></option>
                        <?php
                    }
                    ?>
                </select>

                <div class="row">
                    <div class="col">
                        <label for="mnozstvo"><?php echo $lang["amount"];?></label>
                        <input class="form-control form-control-lg" type="text" id="mnozstvo" name="mnozstvo" placeholder="cislo zadavajte s bodkov">
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $lang["saveSur"];?>" name="priradit">
                        <input type="hidden" name="save" value="yes">
                    </div>
                    <div class="col">
                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="<?php echo $lang["reset"];?>">
                    </div>
                </div>
            </form>
</div>
<?php
}
}
mysqli_close($conn);
include "widgets/footer.php";

?>
