<?php
    $nazovSuboru="Nazov";
    include "header.php";
    $conn="";
    include "config.php";
?>
    <div class="container-fluid">
    <div class="jumbotron-fluid">
        <h1 class="display-4" style="text-align: center">Restaurace</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Domov</a></li>
                <li class="nav-item"><a class="nav-link" href="vkladanie_surovin.php">Vkladanie surovin</a></li>
                <li class="nav-item"><a class="nav-link" href="tbl_suroviny.php">Suroviny</a></li>
                <li class="nav-item"><a class="nav-link" href="recept-component/zoznam_receptov.php">Zoznam receptov</a></li>
            </ul>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Domov</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vkladanie surovin</li>
            </ol>
        </nav>
    </div>
<div class="jumbotron-fluid">
    <h2>Vkladanie surovin</h2>
</div>
<div class="form-group">
<form method="post" autocomplete="on">
    <label for="nazovsuroviny">Nazev suroviny</label>
    <input class="form-control form-control-lg" required autofocus id="nazovsuroviny" name="nazovSuroviny" placeholder="Sem napiste nazov suroviny" type="text">
    <br>

    <label for="nazovsuroviny">kategoria suroviny</label>
    <?php
        $query = "SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny order by id_kategorie ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
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
    <select name="katSuroviny" class="form-control form-control-lg" required autofocus>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <option value="<?php echo $row["id_kategorie"]?>"><?php echo $row["nazov_kategorie"]?></option>
    <?php
            }
    ?>
    </select>
    <br>
    <!--<input required autofocus id="nazovsuroviny" name="katSuroviny">-->

    <input class="btn btn-primary btn-lg" type="submit" value="Ulozit surovinu">
    <input type="hidden" name="send" value="yes">

</form>
</div>
<?php
//vkladanie udajov do DB
if ($_POST["send"] == "yes") {

    $id = 0;

    $query = "INSERT INTO tbl_suroviny (id_suroviny,nazov_suroviny,kategoria_suroviny) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'isi', $id, $_POST["nazovSuroviny"],$_POST["katSuroviny"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

//include "tbl_suroviny.php";

mysqli_close($conn);

?>