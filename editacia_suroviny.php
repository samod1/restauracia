<?php
$conn="";
$nazovSuboru="Editacia suroviny";
$bc_nazov="Editacia suroviny";
include "widgets/header.php";
include "config.php";
include "configDb.php";
include "widgets/navbar.php";
?>
<div class="container-fluid">
<?php
if ($_GET["id"] !=="" && $_GET["edituj"]=="ano")
{
    $idSuroviny = $_GET["id"];
    $query="SELECT kategoria_suroviny,nazov_suroviny,jednotka,nazov_kategorie,id_kategorie,katalogove_cislo,popis_suroviny,dodavatel,hmotnost_brutto,hmotnost_netto FROM tbl_suroviny 
    INNER JOIN enum_kategoria_suroviny ON enum_kategoria_suroviny.id_kategorie = tbl_suroviny.kategoria_suroviny 
    WHERE id_suroviny=".$idSuroviny;

    $result=mysqli_query($conn,$query);

    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    while ($row = mysqli_fetch_assoc($result))
    {
?>
    <h3>Editacia suroviny: <?php echo $row["nazov_suroviny"]?></h3>
    <form method="post" class="form-group">
        <input type="hidden" name="idSuroviny" value="<?php echo $idSuroviny;?>">
        <label>Nazov suroviny</label>
        <input class="form-control form-control-lg" type="text" name="nazovSuroviny" value="<?php echo $row["nazov_suroviny"];?>">
        <br>
        <label>Popis suroviny</label>
        <textarea name="popis" class="form-control" cols="10"><?php echo $row["popis_suroviny"]?></textarea>
        <br>
        <label>Kategoria suroviny</label>
        <select class="form-control form-control-lg" name="kategoria">
            <?php
                $queryKat="SELECT nazov_kategorie, id_kategorie FROM enum_kategoria_suroviny";
                $resultKat=mysqli_query($conn,$queryKat);
                while($rowKat = mysqli_fetch_assoc($resultKat))
                {
                ?>
                    <option value="<?php echo $rowKat["id_kategorie"];?>"
                            <?php

                    if ($rowKat["id_kategorie"] == $row["kategoria_suroviny"])
                        {
                            echo " selected";
                        }

                    ?>><?php echo $rowKat["nazov_kategorie"];?></option>
                <?php
                }
            ?>
        </select>
        <br>
        <label>Merna jednotka</label>
        <select class="form-control form-control-lg" name="jednotka">
            <?php
                $queryJed = "SELECT id_jednotky, jednotka, skratka  FROM enum_jednotka";
                $resultJed = mysqli_query($conn,$queryJed);
                while ($rowJed = mysqli_fetch_assoc($resultJed))
                {
            ?>
                    <option value="<?php $rowJed["id_jednotky"]?>"
                    <?php

                        if($rowJed["id_jednotky"] == $row["jednotka"])
                        {
                            echo " selected";
                        }
                    ?>
                    ><?php echo $rowJed["jednotka"]." (".$rowJed["skratka"].")";?></option>
            <?php
                }
            ?>
        </select>
        <br>
        <label>Dodavatel</label>
        <input class="form-control form-control-lg" type="text" name="dodavatel" value="<?php echo $row["dodavatel"]?>">
        <br>
        <label>Katalogove cislo</label>
        <input class="form-control form-control-lg" type="text" name="katalogove_cislo" value="<?php echo $row["katalogove_cislo"]?>">
        <br>
        <div class="row">
            <div class="col">
                <label>Hmotnost brutto</label>
                <input class="form-control form-control-lg" type="text" name="brutto" value="<?php echo $row["hmotnost_brutto"];?>">

            </div>
            <div class="col">
                <label>Hmotnost netto</label>
                <input class="form-control form-control-lg" type="text" name="netto" value="<?php echo $row["hmotnost_netto"];?>">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="exampleFormControlFile1">Obrazok suroviny</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <br>
        <input type="submit" value="Ulozit" class="btn btn-primary btn-lg btn-block">
        <input type="hidden" name="edit" value="yes">
    </form>
<?php
    }

    if ($_POST["edit"]=="yes")
    {
        $queryEdit="UPDATE tbl_suroviny SET nazov_suroviny=? WHERE id_suroviny=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$queryEdit);
        mysqli_stmt_bind_param($stmt,"si",$_POST["nazovSuroviny"],$_POST["idSuroviny"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Location: tbl_suroviny.php");
    }
}
?>
</div>

<?php
mysqli_close($conn);
include "widgets/footer.php";
?>
