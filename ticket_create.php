<?php
    require("./Assets/Functions/Create_functions.php");
    $DB_Connection = new Create;
    $ErrorGen = $DB_Connection->CheckError();
    require("./Assets/HTML/Header.php");

    $Ticket_Subject = $Ticket_Priority = $Ticket_Message = $Ticket_Attachments = $User_Name = $User_Email = "";
    $TICKET_SUCCESS = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Ticket_Subject = trim($_POST['T_Subject']);
        $Ticket_Priority = trim($_POST['T_Priority']);
        $Ticket_Message = trim($_POST['T_Message']);
        $Ticket_Attachments = $_FILES['T_files'];
        $User_Name = trim($_POST['User_name']);
        $User_Email = trim($_POST['User_email']);
        if($DB_Connection->CreateTicket($Ticket_Subject, $Ticket_Priority, $Ticket_Message, $Ticket_Attachments, $User_Name, $User_Email) == true){
            $TICKET_SUCCESS = True;
            unset($_POST);
        }
    }
?>
<html lang="en">
    <body>
        <div class="container">
            <h1>Create a ticket</h1>
            <hr>
            <div class="alert alert-warning" role="alert">
                The fields with the * icon are required to fill in!
            </div>
            <?php
            echo $DB_Connection->ErrorMSG();
            if($TICKET_SUCCESS == True){ echo $DB_Connection->SuccessMSG(); }
            ?>
            <form method="post" enctype="multipart/form-data">
                <h2>User Info</h2>
                <div class="row">
                    <div class="col-md">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" required name="User_name" id="User_name" class="form-control">
                    </div>
                    <div class="col-md">
                        <label class="form-label">User Email <span class="text-danger">*</span></label>
                        <input type="email" required name="User_email" id="User_email" class="form-control">
                    </div>
                </div>    
                <hr>
                <h2>Ticket Info</h2>
                <div class="row">
                    <div class="col-md">
                        <label class="form-label">Ticket Subject <span class="text-danger">*</span></label>
                        <input type="text" required name="T_Subject" id="T_Subject" class="form-control">
                    </div>
                    <div class="col-md">
                        <label class="form-label">Ticket Priority</label>
                        <input type="number" name="T_Priority" id="T_Priority" value="0" min="0" max="5" class="form-control">
                        <div class="form-text">Priority is measured from 0 (being low priority) till 5 (being high priority)</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ticket Message <span class="text-danger">*</span></label>
                    <textarea required class="form-control" placeholder="Leave a message here" style="height: 200px" name="T_Message" id="T_Message"></textarea>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="T_files">Additional files</label>
                    <input type="file" multiple class="form-control" name="T_files[]" id="T_files">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
<html>