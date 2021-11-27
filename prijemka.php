<?php
$conn ="";
include "configDb.php";
$nazovSuboru="Prijemka";
include "widgets/header.php";
$bc_nazov="Prijemka";
include "widgets/navbar.php";
?>
<h3>Príjemka</h3>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<div class="container-fluid">
    <form method="post" class="form-group">
        <label>Cislo objednavky</label>
        <input class="form-control" type="text" name="cisloObjednavky">

        <label>Variabilny symbol</label>
        <input class="form-control" type="text">

        <label>Datum dorucenia</label>
        <input class="form-control" type="date">

        <label>Datum splatnosti</label>
        <input class="form-control" type="date">

        <label>Prijmovy doklad</label>
        <input class="form-control" type="file">
        <input type="hidden" name="Send" value="yes">
    </form>
    <label></label>
    <div class="row clearfix">
        <div class="col-md-12 column">
            <form method="post">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th class="text-center">
                        Nazov tovaru
                    </th>
                    <th class="text-center">
                        Mnozstvo
                    </th>
                    <th class="text-center">
                        Jednotka
                    </th>
                    <th class="text-center">
                        Datum spotreby
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr id='addr0'>
                    <td>
                        1
                    </td>
                    <td>
                        <select class="form-control">
                            <option></option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name='uname' placeholder='Name' class="form-control" />
                    </td>
                    <td>
                        <input type="text" name='nic' placeholder='NIC' class="form-control" />
                    </td>
                    <td>
                        <input type="date" name='amount' placeholder='Amount' class="form-control" />
                    </td>

                </tr>
                <tr id='addr1'></tr>
                </tbody>
            </table>
        </div>
    </div>
    <button id="add_row" class="btn btn-primary btn-lg pull-left">Pridat riadok</button>

    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                $('tr').find('input').prop('disabled',true)
                $('#addr' + i).html("<td>" + (i + 1) + "</td>" +
                    "<td><input type='text' name='uid" + i + "'  placeholder='User ID' class='form-control input-md'/></td>" +
                    "<td><input type='text' name='uname" + i + "' placeholder='Name' class='form-control input-md'/></td>" +
                    "<td><input type='text' name='nic" + i + "' placeholder='NIC' class='form-control input-md'/></td>" +
                    "<td><input type='text' name='amount" + i + "' placeholder='Amount' class='form-control input-md'/></td>");

                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
        });
    </script>
    <form>
        <br>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Odoslat objednavku">
    </form>
</div>
<?php
include "widgets/footer.php";
mysqli_close($conn);
?>