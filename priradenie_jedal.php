<?php
include "config.php";
$conn="";
$nazovSuboru="Priradenie k menu";
$bc_nazov="Priradenie k menu";

include "configDb.php";
include "widgets/header.php";
include "widgets/navbar.php";

?>
<div class="jumbotron-fluid">
    <div class="row">
        <div class="col">
            <h3>Priradenie jedal k menu</h3>
        </div>

    </div>

    <form class="form-group" method="post">

        <input type="hidden" name="id_menu" value="<?php echo $_GET["menu"];?>">
        <?php
        $query = "SELECT id_dna, den FROM enum_dni WHERE Jazyk = 'SK' ORDER BY id_dna ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
        $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
        ?>
        <label>Den v tyzdni</label>
        <select class="form-control form-control-lg" name="den">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row["id_dna"] ?>" name="den"><?php echo $row["den"] ?></option>
            <?php
            }
            ?>
        </select>
        <br>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="nevari">
            <label class="form-check-label" for="flexCheckDefault">Nevari sa</label>
        </div>
        <br>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#polievka" aria-expanded="false" aria-controls="multiCollapseExample2">Polievka</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#menu1" aria-expanded="false" aria-controls="multiCollapseExample2">Menu 1</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#menu2" aria-expanded="false" aria-controls="multiCollapseExample1">Menu 2</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#menu3" aria-expanded="false" aria-controls="multiCollapseExample1">Menu 3</button>
        <br>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="polievka">
                    <fieldset>
            <legend>Polievka</legend>
            <form method="post" class="form-group">
            <?php
                $queryKat = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu ORDER BY id_typu_receptu ASC";
                $resultKat = mysqli_query($conn,$queryKat);
            ?>
                <label>Kategoria receptu</label>
                <select name="kategoria" class="form-control form-control-lg">
                    <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                    {
                    ?>
                    <option value="<?php echo $rowKat["id_typu_receptu"]?>"><?php echo $rowKat["nazov_typu_receptu"]?></option>
                    <?php }?>
                </select>
                <br>
                <input type="submit" class="btn-primary btn-lg btn-block" value="Zobraz recepty">
            </form>

            <br>
            <label></label>


            <?php
                $queryRec="SELECT id_receptu, nazov_receptu FROM tbl_recept WHERE typ_receptu=".$_POST["kategoria"];
                $resultRec = mysqli_query($conn,$queryRec);
                ?>
            <select class="form-control form-control-lg" name="polievka">
                <?php while ($rowRec = mysqli_fetch_assoc($resultRec))
                {
            ?>
                <option value="<?php echo $rowRec["id_receptu"];?>"><?php echo $rowRec["nazov_receptu"];?></option>
                <?php }?>
            </select>
        </fieldset>
                </div>
            </div>
        <br>
            <div class="col">
                <div class="collapse multi-collapse" id="menu1">
                    <fieldset>
            <legend>menu 1</legend>
            <form method="post" class="form-group">
                <?php
                $queryKat = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu ORDER BY id_typu_receptu ASC";
                $resultKat = mysqli_query($conn,$queryKat);
                ?>
                <label>Kategoria receptu</label>
                <select name="kategoria" class="form-control form-control-lg">
                    <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                    {
                        ?>
                        <option value="<?php echo $rowKat["id_typu_receptu"]?>"><?php echo $rowKat["nazov_typu_receptu"]?></option>
                    <?php }?>
                </select>
                <br>
                <input type="submit" class="btn-primary btn-lg btn-block" value="Zobraz recepty">
            </form>

            <br>
            <label></label>


            <?php
            $queryRec="SELECT id_receptu, nazov_receptu FROM tbl_recept WHERE typ_receptu=".$_POST["kategoria"];
            $resultRec = mysqli_query($conn,$queryRec);
            ?>
            <select class="form-control form-control-lg" name="menu_1">
                <?php while ($rowRec = mysqli_fetch_assoc($resultRec))
                {
                    ?>
                    <option value="<?php echo $rowRec["id_receptu"];?>"><?php echo $rowRec["nazov_receptu"];?></option>
                <?php }?>
            </select>
        </fieldset>
                </div>
            </div>
        <br>
            <div class="col">
                <div class="collapse multi-collapse" id="menu2">
                    <fieldset>
            <legend>menu 2</legend>
            <form method="post" class="form-group">
                <?php
                $queryKat = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu ORDER BY id_typu_receptu ASC";
                $resultKat = mysqli_query($conn,$queryKat);
                ?>
                <label>Kategoria receptu</label>
                <select name="kategoria" class="form-control form-control-lg">
                    <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                    {
                        ?>
                        <option value="<?php echo $rowKat["id_typu_receptu"]?>"><?php echo $rowKat["nazov_typu_receptu"]?></option>
                    <?php }?>
                </select>
                <br>
                <input type="submit" class="btn-primary btn-lg btn-block" value="Zobraz recepty">
            </form>

            <br>
            <label></label>


            <?php
            $queryRec="SELECT id_receptu, nazov_receptu FROM tbl_recept WHERE typ_receptu=".$_POST["kategoria"];
            $resultRec = mysqli_query($conn,$queryRec);
            ?>
            <select class="form-control form-control-lg" name="menu_2">
                <?php while ($rowRec = mysqli_fetch_assoc($resultRec))
                {
                    ?>
                    <option value="<?php echo $rowRec["id_receptu"];?>"><?php echo $rowRec["nazov_receptu"];?></option>
                <?php }?>
            </select>
        </fieldset>
                </div>
            </div>
        <br>
            <div class="col">
                <div class="collapse multi-collapse" id="menu3">
                    <fieldset>
            <legend>menu 3</legend>
            <form method="post" class="form-group">
                <?php
                $queryKat = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu ORDER BY id_typu_receptu ASC";
                $resultKat = mysqli_query($conn,$queryKat);
                ?>
                <label>Kategoria receptu</label>
                <select name="kategoria" class="form-control form-control-lg">
                    <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                    {
                        ?>
                        <option value="<?php echo $rowKat["id_typu_receptu"]?>"><?php echo $rowKat["nazov_typu_receptu"]?></option>
                    <?php }?>
                </select>
                <br>
                <input type="submit" class="btn-primary btn-lg btn-block" value="Zobraz recepty">
            </form>

            <br>
            <label></label>


            <?php
            $queryRec="SELECT id_receptu, nazov_receptu FROM tbl_recept WHERE typ_receptu=".$_POST["kategoria"];
            $resultRec = mysqli_query($conn,$queryRec);
            ?>
            <select class="form-control form-control-lg" name="menu_3">
                <?php while ($rowRec = mysqli_fetch_assoc($resultRec))
                {
                    ?>
                    <option value="<?php echo $rowRec["id_receptu"];?>"><?php echo $rowRec["nazov_receptu"];?></option>
                <?php }?>
            </select>
        </fieldset>
                </div>
            </div>
        </div>
        <br>
        <input class="btn btn-primary btn-lg btn-block" type="submit" name="ulozit">
         <input type="hidden" name="send" value="yes">
    </form>
    <br>
    <?php
        if($_POST["send"]=="yes")
        {
            $query = "INSERT INTO tbl_jedla_menu (id_menu, den, polievka, menu1, menu2, menu3) VALUES (?,?,?,?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt, 'iiiiii', $_POST["id_menu"], $_POST["den"], $_POST["polievka"],$_POST["menu_1"],$_POST["menu_2"],$_POST["menu_3"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    ?>
</div>
<?php
    include "widgets/footer.php"

?>
