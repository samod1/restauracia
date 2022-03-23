<?php
$conn = "";
include "../configDb.php";

if (isset($_POST["meno"]) && isset($_POST["heslo"]) && isset($_POST["prihlaste_sa"]))
{
    $query = "Select uzivatelske_meno,heslo FROM login_test.uzivatel WHERE uzivatelske_meno =".$_POST["meno"];
    $result = mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($result))
    {
        if ($row["heslo"] == $_POST["heslo"])
        {
            echo "ok";
        }

        else
        {
            echo "Fuck  up";
        }
    }

}