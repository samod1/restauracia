<?php
$conn="";
$nazovSuboru="Editacia suroviny";
$bc_nazov="Editacia suroviny";
include "widgets/header.php";
include "config.php";
include "widgets/navbar.php";

if ($_GET["id"] !=="")
{
    $idSuroviny = $_GET["id"];
    $query="SELECT nazov_suroviny,nazov_kategorie,id_kategorie FROM restauracia.tbl_suroviny 
    INNER JOIN restauracia.enum_kategoria_suroviny ON enum_kategoria_suroviny.id_kategorie = tbl_suroviny.kategoria_suroviny 
    WHERE id_suroviny=".$idSuroviny;

    $result=mysqli_query($conn,$query);

    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    ?>
    <h3>Editacia suroviny</h3>
    <br>
    <form method="post" class="form-group">
    <?php
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <label>Nazov suroviny</label>
        <input name="surovina" type="text" class="form-control" value="<?php echo $row["nazov_suroviny"]?>">
        <label>Kategoria suroviny</label>
        <select class="form-control" name="kategoria">
            <option value="<?php echo $row["id_kategorie"] ?>"><?php echo $row["nazov_kategorie"] ?></option>
        </select>

    <?php
    }
    ?>
        <br>
        <input type="submit" class="btn btn-primary btn-lg btn-block">
        <input type="hidden" name="edit" value="yes">
    </form>
<?php
    if ($_POST["edit"]=="yes")
    {
        $queryEdit="UPDATE restauracia.tbl_suroviny SET nazov_suroviny='?' WHERE id_suroviny=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"si",$_POST["surovina"],$idSuroviny);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Location: tbl_suroviny.php");
    }
}
mysqli_close($conn);
include "widgets/footer.php";
?>
