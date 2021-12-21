<?php
$conn="";
$nazovSuboru="Editacia suroviny";
$bc_nazov="Editacia suroviny";
include "widgets/header.php";
include "config.php";
include "configDb.php";
include "widgets/navbar.php";

if ($_GET["id"] !=="" && $_GET["edituj"]=="ano")
{
    $idSuroviny = $_GET["id"];
    $query="SELECT nazov_suroviny,nazov_kategorie,id_kategorie FROM tbl_suroviny 
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
    <form method="post" class="form-group">
        <input type="hidden" name="idSuroviny" value="<?php echo $idSuroviny;?>">
        <label>Nazov suroviny</label>
        <input class="form-control form-control-lg" type="text" name="nazovSuroviny" value="<?php echo $row["nazov_suroviny"];?>">
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
mysqli_close($conn);
include "widgets/footer.php";
?>
