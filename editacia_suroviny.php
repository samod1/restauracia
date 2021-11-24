<?php
$conn="";
$nazovSuboru="Editacia suroviny";
$bc_nazov="Editacia suroviny";
include "widgets/header.php";
include "config.php";
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
    while ($row = mysqli_fetch_assoc($result)) {
        $nazovSurovinyp = $row["nazov_suroviny"];
    }

    include "spracovania/Edit_form.php";
}
    if ($_POST["edit"]=="yes")
    {
        $queryEdit="UPDATE tbl_suroviny SET nazov_suroviny='?' WHERE id_suroviny=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$queryEdit);
        mysqli_stmt_bind_param($stmt,"si",$_POST["surovina"],$idSuroviny);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Location: tbl_suroviny.php");
    }

mysqli_close($conn);
include "widgets/footer.php";
?>
