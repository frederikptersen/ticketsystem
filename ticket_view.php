<?php
    require("./Assets/Functions/View_functions.php");
    $DB_Connection = new ViewFunctions;
    $ErrorGen = $DB_Connection->CheckError();
    $TicketData = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" or $_SERVER["REQUEST_METHOD"] == "GET"){
        $TicketData = $DB_Connection->GetTicketData($_GET['ticket_id']);
        $Ticket_Attachments = $DB_Connection->GetTicketAttachments($TicketData['Ticket_Attachments'], $TicketData['Ticket_Id'], $TicketData['User_Name']);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['Ticket_ID'])){
                $Ticket_ID = trim($_POST['Ticket_ID']);
                $Ticket_Username = trim($_POST['Ticket_Username']);
                $Reaction_Username = trim($_POST['User_name']);
                $Reaction_Email = trim($_POST['User_email']);
                $Reaction_Message = trim($_POST['T_Message']);
                $Ticket_Attachments_upload = $_FILES['T_files'];
                if($DB_Connection->CreateTicket_reaction($Ticket_ID, $Ticket_Username, $Reaction_Username, $Reaction_Email, $Reaction_Message, $Ticket_Attachments_upload) == True){
                    header("Refresh:0");
                }
            }
        }
        $Response_Data = $DB_Connection->BuildReactions($_GET['ticket_id'], $TicketData['User_Name']);
    }
    require("./Assets/HTML/Header_Ticket.php");
?>
<html lang="en">
    <body>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 bg-light" >
                    <div class="d-flex flex-column align-items-center align-items-sm-start pt-2 min-vh-100 text-dark">
                        <h1>TICKETSUBJECT</h1>
                        <div class="list-group gap-2 border-0 d-grid" style="width: 100%;">
                            <label class="list-group-item rounded-3 col-md-3 py-3" style="width: 100%;" for="listGroupCheckableRadios1">
                            Ticket Submitted by
                            <span class="d-block small"><a href='mailto:<?=$TicketData['User_Email']?>'><?=$TicketData['User_Name']?></a></span>
                            </label>

                            <label class="list-group-item rounded-3 col-md-3 py-3" style="width: 100%;" for="listGroupCheckableRadios1">
                            Ticket Priority
                            <span class="d-block small"><?=$TicketData['Ticket_Priority']?></span>
                            </label>

                            <label class="list-group-item rounded-3 col-md-3 py-3" style="width: 100%;" for="listGroupCheckableRadios1">
                            Ticket Date
                            <span class="d-block small"><?= date("G:i - d/m/Y", strtotime($TicketData['Ticket_DateTime'])) ?></span>
                            </label>

                            <label class="list-group-item rounded-3 col-md-3 py-3" style="width: 100%;" for="listGroupCheckableRadios1">
                            Ticket Message
                            <span class="d-block small"><?=$TicketData['Ticket_Message']?></span>
                            </label>

                            <label class="list-group-item rounded-3 col-md-3 py-3" style="width: 100%;" for="listGroupCheckableRadios1">
                            Ticket Attachments
                            <span class="d-block small"><?=$Ticket_Attachments?></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col py-3">
                    <h2>Reactions</h2>
                    <div class="list-group">

                        <?=$Response_Data?>

                        <div class="list-group-item list-group-item-action gap-3 py-3">
                            <h3>New Reaction</h3>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" required name="Ticket_ID" value="<?=$TicketData['Ticket_Id']?>">
                                <input type="hidden" required name="Ticket_Username" value="<?=$TicketData['User_Name']?>">
                                <h4>User Info</h4>
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
                                <h4>Reaction Info</h4>
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
                    </div>
                </div>
            </div>
        </div>
    </body>
<html>