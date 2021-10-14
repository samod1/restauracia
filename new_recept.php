<?php
$conn="";
include "config.php";

$nazovSuboru="Novy recept";
include "widgets/header.php";

$bc_nazov = "Novy recept";
include "widgets/navbar.php";
?>

<h2>Vytvorit novej recept</h2>
<div class="container-fluid">
<form method="post" class="form-group">
    <label for="nazovReceptu">Nazov receptu</label>
    <input class="form-control form-control-lg" required autofocus type="text" name="nazovReceptu">
    <br>
    <label for="typ_kuchyna">Druh receptu</label>

    <?php
    $query = "SELECT id_typu_receptu, nazov_typu_receptu FROM typ_receptu ORDER BY id_typu_receptu ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
    $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
    $pocetRiadkov = mysqli_num_rows($result);
    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    if ($pocetRiadkov == 0) {

        echo "Nemam co zobrazit";
    }
    ?>

    <select name="typKuchyne" class="form-control form-control-lg" required autofocus>
        <?php

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <option value="<?php echo $row["id_typu_receptu"]?>"><?php echo $row["nazov_typu_receptu"]?></option>
        <?php
        }
        ?>
    </select>
    <br>
    <label>Postup pripravy</label>
    <textarea class="form-control" rows="10" name="postupReceptu"></textarea>
    <br>
    <input class="btn btn-primary btn-lg btn-block"type="submit" value="Ulozit">
    <input type="hidden" name="send" value="yes">
</form>
</div>
<?php
//vkladanie udajov do DB
if ($_POST["send"] == "yes") {

    $id = 0;
    $query = "INSERT INTO recept (id,nazov,postup,typ_receptu) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'issi', $id, $_POST["nazovReceptu"],$_POST["postupReceptu"],$_POST["typKuchyne"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

//include "tbl_suroviny.php";

mysqli_close($conn);
include "widgets/footer.php";
?>