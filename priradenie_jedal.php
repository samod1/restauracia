<?php
include "config.php";
$stranka = "listky";
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
            <br>
            <h3>Priradenie jedal k menu</h3>
        </div>

    </div>
        <form class="form-group" method="post">

        </form>

        <form class="form-group" method="post">
            <div class="form-check">
                <!-- TODO ak sa oznaci toto pole ako 1 tak zakazat vsetky ostatne polia -->
                <script type="text/javascript">
                    function enable_disable() {
                        $("input").prop('disabled', false);
                    }
                </script>
                <input class="form-check-input" id="nevarisa" type="checkbox" name="nevari_sa" onclick="checkboxClick()">
                <label class="form-check-label" for="nevarisa">Nevari sa</label>
            </div>
            <label>Den v tyzdni</label>
            <select id="input" name="den" class="form-control form-control-lg">
                <?php
                $query="SELECT id_dna, den FROM enum_dni WHERE Jazyk='SK'";
                $result=mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($result))
                {
                    ?>
                    <option value="<?php echo $row["id_dna"]?>"><?php echo $row["den"]; ?></option>
                    <?php
                }
                ?>
            </select>

            <label>Menu tyzdna</label>
            <select id="input" class="form-control form-control-lg" name="menuid">
                <?php
                    $query = "SELECT id_menu, datum_od, datum_do FROM tbl_menu ORDER BY id_menu";
                    $result = mysqli_query($conn,$query);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                ?>
                        <option value="<?php echo $row["id_menu"];?>"><?php echo $row["datum_od"]." - ".$row["datum_do"];?></option>
                <?php
                    }
                ?>
            </select>

                    <?php

           ?>
            <br>
            <label>Polievka</label>
            <select name="polievka" class="form-control form-control-lg">
                <?php
                    $query="SELECT nazov_receptu, id_receptu FROM tbl_recept WHERE typ_receptu=8";
                    $result= mysqli_query($conn,$query);
                    while ($row=mysqli_fetch_assoc($result))
                    {
                        echo "<option value=".$row["id_receptu"].">".$row["nazov_receptu"]."</option>";
                    }
                ?>
            </select>
            <br>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Menu 1</label>
                    <select name="menu1" class="form-control form-control-lg">
                        <?php
                            $queryMen1="SELECT id_receptu,nazov_receptu FROM tbl_recept WHERE Denne_menu=1 AND typ_receptu !=8 ORDER BY nazov_receptu ASC";
                            $resultMen1=mysqli_query($conn,$queryMen1);
                            while ($rowMen1 = mysqli_fetch_assoc($resultMen1))
                            {
                                echo "<option value=".$rowMen1["id_receptu"].">".$rowMen1["nazov_receptu"]."</option>";
                            }
                        ?>
                    </select>
                </div>


                <div class="col-4">
                    <label class="form-label">Menu 2</label>
                    <select class="form-control form-control-lg">
                        <?php
                        $queryMen2="SELECT id_receptu,nazov_receptu FROM tbl_recept WHERE Denne_menu=1 AND typ_receptu !=8 ORDER BY nazov_receptu ASC";
                        $resultMen2=mysqli_query($conn,$queryMen1);
                        while ($rowMen2 = mysqli_fetch_assoc($resultMen2))
                        {
                            echo "<option value=".$rowMen2["id_receptu"].">".$rowMen2["nazov_receptu"]."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label class="form-label">Menu 3</label>
                    <select class="form-control form-control-lg">
                        <?php
                        $queryMen3="SELECT id_receptu,nazov_receptu FROM tbl_recept WHERE Denne_menu=1 AND typ_receptu !=8 ORDER BY nazov_receptu ASC ";
                        $resultMen3=mysqli_query($conn,$queryMen3);
                        while ($rowMen3 = mysqli_fetch_assoc($resultMen3))
                        {
                            echo "<option value=".$rowMen3["id_receptu"].">".$rowMen3["nazov_receptu"]."</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
            <br>
            <input name="odoslat" type="submit" class="btn btn-primary btn-lg btn-block" value="Ulozit den">

        </form>
        <?php
            if (isset($_POST["odoslat"]))
            {
                //if checked
                if (isset($_POST["nevari_sa"]))
                {
                    $nevariSa = 1;
                    $query = "INSERT INTO tbl_jedla_menu (id_menu, den, nevari_sa) VALUES (?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $query);
                    mysqli_stmt_bind_param($stmt, 'iii', $_POST["menuid"],$_POST["den"],$nevariSa);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                else
                {
                    $nevariSa = 0;
                    $query = "INSERT INTO tbl_jedla_menu (id_menu, den, polievka, menu1, menu2, menu3, nevari_sa) VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $query);
                    mysqli_stmt_bind_param($stmt, 'iiiiii', $_POST["menuid"],$_POST["den"],$_POST["polievka"],$_POST["menu1"],$_POST["menu2"],$_POST["menu3"],$nevariSa);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }

            }
        ?>
</div>
<?php
    include "widgets/footer.php"

?>
