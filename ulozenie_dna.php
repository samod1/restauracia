<?php
$conn = "";
require_once "configDb.php";

if($_POST["send"] == "yes")
{

    echo $_POST["id_menu"];
    echo $_POST["den"];
    echo $_POST["polievka"];
    echo $_POST["menu_1"];
    echo $_POST["menu_2"];
    echo $_POST["menu_3"];




    $querySend = "INSERT INTO tbl_jedla_menu (id_menu, den, polievka, menu1, menu2, menu3) VALUES (?,?,?,?,?,?) ";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $querySend);
    mysqli_stmt_bind_param($stmt, 'iiiiii', $_POST["id_menu"], $_POST["den"], $_POST["polievka"],$_POST["menu_1"],$_POST["menu_2"],$_POST["menu_3"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>