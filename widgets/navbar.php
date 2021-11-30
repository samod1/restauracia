<div class="container-fluid">
    <div class="jumbotron-fluid">
        <h1 class="display-4" style="text-align: center"><?php echo $lang["TITLE"]; ?></h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar nav">
                <li class="nav-item"><a class="nav-link" href="../index.php"><?php echo $lang["HOME"];?></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $lang["INGREDIENTS"];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../tbl_suroviny.php">Zoznam surovín</a>
                        <a class="dropdown-item" href="../vkladanie_surovin.php">Vkladanie surovín</a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Recepty</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../zoznam_receptov.php">Zoznam receptov</a>
                        <a class="dropdown-item" href="../new_recept.php">Vytvoriť nový recept</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../jedalny_listok.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $lang["MENUS"];?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../jedalny_listok.php">Jedálne lístky</a>
                        <a class="dropdown-item" href="../nove_menu.php">Vytvoriť nové menu</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../sklad.php"><?php echo $lang["STORAGE"];?></a>
                </li>


            </ul>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php"><?php echo $lang["HOME"]?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $bc_nazov?></li>
            </ol>
        </nav>
    </div>