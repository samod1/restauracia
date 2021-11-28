<?php
include "config.php";
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov= $lang["suroviny"];
include "widgets/navbar.php";
$conn = "";
include "configDb.php";
?>
<div class="container-fluid">
    <h3><?php echo $lang["suroviny"];?></h3>
<div class="row">
    <form class="form-group" method="post">
        <div class="col-6">
            <label><?php echo $lang["kat_suroviny"];?></label>
            <select name="kategoria" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php
                    $query="SELECT id_kategorie,nazov_kategorie FROM enum_kategoria_suroviny order by nazov_kategorie ASC";
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
        <div class="col-2">
            <input type="submit" value="<?php echo $lang["hladaj"];?>" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>

<?php
if ($_POST["kategoria"]!="")
{
    $querySur = "SELECT nazov_suroviny,Mnozstvo,jednotka FROM tbl_suroviny 
    INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky ORDER BY nazov_suroviny ASC";
    $resultSur = mysqli_query($conn,$querySur);
    $pocetRiadkovSur = mysqli_num_rows($resultSur);
    if ($pocetRiadkovSur == 0)
    {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <strong>".$lang["noRecords"]."</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    else
    {
        $querySur = "SELECT nazov_suroviny,Mnozstvo,jednotka FROM tbl_suroviny 
        INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky  WHERE kategoria_suroviny=".$_POST["kategoria"]." ORDER BY nazov_suroviny ASC";
        $resultSur = mysqli_query($conn,$querySur);
        ?>
        <table class="table table-stripped">
            <thead>
                <th><?php echo $lang["nazov"]; ?></th>
                <th><?php echo $lang["mnozstvo"]; ?></th>
            </thead>

            <tbody>
            <?php
        while ($row=mysqli_fetch_assoc($resultSur))
        { ?>
            <td><?php echo $row["nazov_suroviny"]?></td>
            <td><?php echo $row["mnozstvo"]." ".$row["jednotka"]?></td>
       <?php } ?>
            </tbody>
        </table>
            <?php
    }
}
?>

</div>
<?php
    include_once "widgets/footer.php";
    mysqli_close($conn);
?>