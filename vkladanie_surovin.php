<?php
include "header.php";
    $conn="";
    include "config.php";

    ?>

<form action="vkladanie_surovin.php" method="post" autocomplete="on">
    <label for="nazovsuroviny">Nazev suroviny</label>
    <input required autofocus id="nazovsuroviny" name="nazovSuroviny" placeholder="Sem napiste nazov suroviny" type="text">
    <input type="submit" value="Ulozit surovinu">
    <input type="hidden" name="send" value="yes">

</form>
<?php

//vkladanie udajov do DB
if ($_POST["send"] == "yes") {

    $id = 0;

    $query = "INSERT INTO tbl_suroviny (id_suroviny,nazov_suroviny) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'is', $id, $_POST["nazovSuroviny"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>