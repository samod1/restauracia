<?php
$conn ="";
include "config.php";
$nazovSuboru="Prijemka";
include "widgets/header.php";
$bc_nazov="Prijemka";
include "widgets/navbar.php";
?>
<h3>Príjemka</h3>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th class="text-center">
                        User ID
                    </th>
                    <th class="text-center">
                        Name
                    </th>
                    <th class="text-center">
                        NIC
                    </th>
                    <th class="text-center">
                        Amount
                    </th>
                    <th class="text-center">
                        Date
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr id='addr0'>
                    <td>
                        1
                    </td>
                    <td>
                        <input type="text" name='uid' placeholder='User ID' class="form-control" />
                    </td>
                    <td>
                        <input type="text" name='uname' placeholder='Name' class="form-control" />
                    </td>
                    <td>
                        <input type="text" name='nic' placeholder='NIC' class="form-control" />
                    </td>
                    <td>
                        <input type="text" name='amount' placeholder='Amount' class="form-control" />
                    </td>
                    <td>
                        <input type="date" name='dt' placeholder='Date' class="form-control" />
                    </td>
                </tr>
                <tr id='addr1'></tr>
                </tbody>
            </table>
        </div>
    </div>
    <button id="add_row" class="btn btn-primary btn-lg pull-left">SUBMIT</button>

    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                $('tr').find('input').prop('disabled',true)
                $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input type='text' name='uid" + i + "'  placeholder='User ID' class='form-control input-md'/></td><td><input type='text' name='uname" + i + "' placeholder='Name' class='form-control input-md'/></td><td><input type='text' name='nic" + i + "' placeholder='NIC' class='form-control input-md'/></td><td><input type='text' name='amount" + i + "' placeholder='Amount' class='form-control input-md'/></td><td><input type='date' name='dt" + i + "' placeholder='Date' class='form-control input-md'/></td>");

                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
        });
    </script>
</div>
