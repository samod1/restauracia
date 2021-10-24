<?php
$conn ="";
include "config.php";
$nazovSuboru="Priradenie surovin";
include "widgets/header.php";
$bc_nazov="Priradenie surovin";
include "widgets/navbar.php";
?>
<div class="jumbotron-fluid">

<?php
if ($_GET["id"] != "") {
    $queryNazov="SELECT nazov,postup FROM recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
        { echo "<h3>Priradenie surovin k receptu ".$rowNazov["nazov"]."</h3>"
            ?>
    <form method="get" class="form-group">
        <div class="row"></div>
        <div class="row">
            <div class="col">
                <?php
                    $queryKat="SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                    $resultKat= mysqli_query($conn,$queryKat);

                ?>
                    <select class="form-control form-control-lg">
                        <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                        {
                            ?>
                        <option value="<?php echo $rowKat["id_kategorie"]?>"><?php echo $rowKat["nazov_kategorie"]?></option>
                            <?php
                        }
                        ?>
                    </select>

            </div>
            <div class="col">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Zobraz suroviny">
                <input type="hidden" name="zobraz" value="yes">
            </div>
        </div>
    
    </form>
            <form method="get" class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">Veprova panenka</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">Hovedzi kyta</label>
                </div>

                
                <div class="row">
                    <div class="col">
                        <label for="mnozstvo">Mnozstvi</label>
                        <input class="form-control" type="number" id="mnozstvo">
                    </div>
                    <div class="col">
                        <label>Jednotka</label>
                        <select class="form-control">
                            <option>Kilogram</option>
                            <option>Liter</option>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary btn-lg btn-block">
            </form>
</div>
<?php
        }
}
?>