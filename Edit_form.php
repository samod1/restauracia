<h3>Editacia suroviny</h3>
<br>
<form action="editacia_suroviny.php" method="post" class="form-group">
    <label>Nazov suroviny</label>
    <input name="surovina" type="text" class="form-control" value="<?php echo $nazovSurovinyp?>">
    <br>
    <input type="submit" class="btn btn-primary btn-lg btn-block">
    <input type="hidden" name="edit" value="yes">
</form>