<div class="container-fluid">
    <div class="jumbotron-fluid">
        <h1 class="display-4" style="text-align: center"><?php echo $lang["TITLE"]; ?></h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">doRest</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($stranka == "domov") {echo " active";} ?>">
                        <a class="nav-link" href="../index.php">Domov</a>
                    </li>
                    <li class="nav-item <?php if ($stranka == "suroviny") {echo " active";} ?>">
                        <a class="nav-link" href="../tbl_suroviny.php">Suroviny</a>
                    </li>
                    <li class="nav-item <?php if ($stranka == "recepty") {echo " active";} ?>">
                        <a class="nav-link" href="../zoznam_receptov.php">Recepty</a>
                    </li>

                    <li class="nav-item <?php if ($stranka == "listky") {echo " active";} ?>">
                        <a class="nav-link" href="../prehlad_jedalnych_listkov.php">Jedalne listky</a>
                    </li>
                    <li class="nav-item <?php if ($stranka == "sklad") {echo " active";} ?>">
                        <a class="nav-link" href="../sklad.php">Sklad</a>
                    </li>
                    <li class="nav-item <?php if ($stranka == "kategorie") {echo " active";} ?>">
                        <a class="nav-link" href="../kategorie.php">Hodnoty čísleníkov</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>