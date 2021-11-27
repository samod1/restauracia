<?php
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
        <?php
        $query = "SELECT id_dna, den FROM enum_dni ORDER BY id_dna ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
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
        <label>Den v tyzdni</label>
        <select class="form-control form-control-lg">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row["id_dna"] ?>" name="den"><?php echo $row["den"] ?></option>
            <?php
            }
            ?>
        </select>
        <label></label>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Zvolit</th>
                    <th>Nazov jedla</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td>Kulajda</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Kulajda</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Kulajda</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Kulajda</td>
            </tr>
            </tbody>
        </table>
        <input class="btn btn-primary btn-lg btn-block" type="submit" name="ulozit">
         <input type="hidden" name="send" value="yes">
    </form>
</div>
<?php
    include "widgets/footer.php"

?>
