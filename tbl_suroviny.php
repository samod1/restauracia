<?php
include "config.php";

$nazovSuboru= $lang["suroviny"];
include "widgets/header.php";

$bc_nazov= $lang["suroviny"];
include "widgets/navbar.php";

$conn = "";
include "configDb.php";
?>
<div class="container-fluid">
    <h3><?php echo $lang["suroviny"];?></h3>
<div class="row">
    <div class="col"><a href="vkladanie_surovin.php" class="btn btn-primary btn-lg"><?php echo $lang["novaSur"]?></a> </div>
</div>
    <form method="get" class="form-group">
        <div class="row">
            <label><?php echo $lang["kat_suroviny"];?></label>
            <div class="col-8">
                <select name="kategoria" class="form-control form-control-lg">
                    <?php
                    $query="SELECT id_kategorie,nazov_kategorie FROM enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                    $result = mysqli_query($conn,$query);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>
                        <option value="<?php echo $row["id_kategorie"];?>"><?php echo $row["nazov_kategorie"];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-4">
                <input type="submit" value="<?php echo $lang["hladaj"];?>" class="btn btn-primary btn-lg">
            </div>
    </form>

</div>

<?php
if ($_GET["kategoria"] != "")
{
    $queryKat = "SELECT nazov_suroviny FROM tbl_suroviny";
    $resultKat = mysqli_query($conn,$queryKat);
    $pocetRiadkovSur = mysqli_num_rows($resultKat);

    if ($pocetRiadkovSur == 0)
    {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <strong>".$lang["noRecords"]."</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    else
    {
        $querySur = "SELECT nazov_suroviny,Mnozstvo,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky WHERE kategoria_suroviny =". $_GET["kategoria"];
        $resultSur = mysqli_query($conn,$querySur);
        ?>
        <table class="table table-stripped">
            <thead>
                <th><?php echo $lang["nazov"]; ?></th>
                <th><?php echo $lang["mnozstvo"]; ?></th>
            </thead>


            <tbody>
            <?php
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            { ?>
                <td><?php echo $rowSur["nazov_suroviny"];?></td>
                <td><?php echo $rowSur["Mnozstvo"]." ".$rowSur["skratka"];?></td>
       <?php } ?>
            </tbody>
        </table>
            <?php
    }
}

else
{
    $querySur = "SELECT nazov_suroviny,Mnozstvo,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky";
    $resultSur = mysqli_query($conn,$querySur);
    ?>
    <table class="table table-stripped">
        <thead>
            <th><?php echo $lang["nazov"]; ?></th>
            <th><?php echo $lang["mnozstvo"]; ?></th>
        </thead>


        <tbody>
        <?php
        while ($rowSur = mysqli_fetch_assoc($resultSur))
        { ?>
                <tr>
                    <td><?php echo $rowSur["nazov_suroviny"];?></td>
                    <td><?php echo $rowSur["Mnozstvo"]." ".$rowSur["skratka"];?></td>
                </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php
}

?>

</div>
<?php
    include_once "widgets/footer.php";
    mysqli_close($conn);
?>