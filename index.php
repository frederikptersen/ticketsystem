<?php
    require("./Assets/Functions/Overview_functions.php");
    $DB_Connection = new Overview;
    $ErrorGen = $DB_Connection->CheckError();
    require("./Assets/HTML/Header.php");
?>
<html lang="en">
    <body>
        <div class="container">
            <table id="Ticket_View" class="table">
                <thead>
                    <tr>
                        <th>Ticket_ID</th>
                        <th>Ticket Subject</th>
                        <th>Date Submitted</th>
                        <th>User</th>
                        <th>Priority</th>
                        <th>Reaction count</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$DB_Connection->Generate_Table();?>
                </tbody>
            </table>
        </div>
    </body>
<html>
<script>
    let table = new DataTable('#Ticket_View', {
        bLengthChange: false,
        order: [[2, 'desc']],
        columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            }
        ]
    });
</script>