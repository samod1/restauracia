<style>
    .footer {
        left: 0;
        position: sticky;
        position: -webkit-sticky;
        bottom: 0;
        text-align: center;
        color: white;
        width: 100%;
    }
</style>

<div class="footer bg-dark">
    <div class="row">
        <div class="col">
            <p>&copy; Samuel Domin</p>
        </div>
        <div class="col">
            <p><a href="index.php?lang=sk"><?php echo $lang['lang_sk'] ?></a> | <a href="index.php?lang=cz"><?php echo $lang['lang_cz'] ?></a></p>
        </div>
        <div class="col">
            <?php
                echo "verzia: ".exec("git log --pretty=%h -n1 HEAD");
            ?>
        </div>
    </div>

</div>