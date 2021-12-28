<?php
$conn="";
include "config.php";
include "configDb.php";
$nazovSuboru="Editacia receptu";
include "widgets/header.php";

$bc_nazov="Editacia receptu";
include "widgets/navbar.php";

if($_GET["id"] !="" && $_GET["edituj"]="yes")
{
?>
<div class="container-fluid">
    <h3>Editacia receptu</h3>
    <form class="form-group" method="post" action="spracovanie/spracovanie_editacie.php">
        <input name="idReceptu" type="hidden" value="<?php echo $_GET["id"];?>">
        <?php
            $query="SELECT nazov_receptu,postup_receptu,cena_jedla,alergeny FROM demorest.tbl_recept WHERE id_receptu=".$_GET["id"];
            $result = mysqli_query($conn,$query);
            while ($rowRec = mysqli_fetch_assoc($result))
            {
        ?>
        <label>Nazov receptu</label>
        <input name="nazovReceptu" class="form-control form-control-lg" type="text" value="<?php echo $rowRec["nazov_receptu"];?>">
        <br>

        <label><?php echo $lang["postup"];?></label>
        <textarea name="postupReceptu" class="form-control" rows="10" value="<?php echo $rowRec["postup_receptu"];?>"><?php echo $rowRec["postup_receptu"];?></textarea>
        <br>

        <label>Alergeny</label>
        <input name="alergeny" class="form-control form-control-lg" type="text" value="<?php echo $rowRec["alergeny"];?>"><br>

                <br>
        <label>Cena jedla</label>
        <input name="cenaJedla" class="form-control form-control-lg" type="text" value="<?php echo $rowRec["cena_jedla"];?>">
        <br>
            <?php }?>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Ulozit">
        <input type="hidden" name="edit" value="yes">

    </form>
</div>
<?php

}
include "widgets/footer.php";
?>