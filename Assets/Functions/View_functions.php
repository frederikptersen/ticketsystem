<?php
    require('Functions.php');
    class ViewFunctions extends DB_Connection{
        public function GetTicketData($Ticket_ID){
            $Get_Data = "SELECT * FROM ticket WHERE Ticket_Id=:id LIMIT 1;";
            $stmt = $this->PDO_CONNECTION->prepare($Get_Data);
            $stmt->execute(array(':id' => $Ticket_ID));
            $Ticket_data = $stmt->fetch(PDO::FETCH_ASSOC);

            $ReturnArray = array();
            if($Ticket_data != null){
                $ReturnArray = $Ticket_data;
            }
            return $ReturnArray;
        }

        public function GetTicketAttachments($Ticket_Data_Ticket_Attachments, $Ticket_ID, $Ticket_USER){
            $Unserialize_Array = unserialize($Ticket_Data_Ticket_Attachments);
            $ReturnMSG = "";
            if(!empty($Unserialize_Array)){
                foreach ($Unserialize_Array as $file_Name) {
                    $ReturnMSG .= "<a download href='Assets/Uploads/".$Ticket_ID."_".$Ticket_USER."/".$file_Name."'>".$file_Name."</a>" . "<br>";
                }
            }else{
                $ReturnMSG = "There are no Attachments!";
            }
            return $ReturnMSG;
        }

        public function CreateTicket_reaction($Ticket_ID, $Ticket_Username, $Reaction_Username, $Reaction_Email, $Reaction_Message, $Ticket_Attachments){
            $Attachments_serialized="";
            $result = false;

            $Attachments_serialized = $this->PrepareAttachments($Ticket_Attachments);

            $INSERT_ARRAY = array(
                ':Ticket_id' => $Ticket_ID,
                ':Response_User' => $Reaction_Username,
                ':Response_Email' => $Reaction_Email,
                ':Response_Message' => $Reaction_Message,
                ':Response_Attachments' => $Attachments_serialized[1]
            );

            $Insert_Query= "INSERT INTO ticket_response (Ticket_id, Response_User, Response_Email, Response_Message, Response_Attachments) VALUES (:Ticket_id, :Response_User, :Response_Email, :Response_Message, :Response_Attachments)";
            $stmt = $this->PDO_CONNECTION->prepare($Insert_Query);
            if($stmt->execute($INSERT_ARRAY)){
                $Ticket_Response_ID = $this->PDO_CONNECTION->lastInsertId();
                $result = True;
                if($this->UploadAttachments($Ticket_Response_ID, $Attachments_serialized[0], $Ticket_Attachments, $Reaction_Username, $Ticket_ID, $Ticket_Username) == true){
                    $result = True;
                } 
            }
            
            return $result;
        }

        private function PrepareAttachments($Attachment_array){
            $ReturnValue = array();
            array_push($ReturnValue, count($Attachment_array['name']));
            array_push($ReturnValue, serialize($Attachment_array['name']));
            return $ReturnValue;
        }

        private function UploadAttachments($Ticket_Response_ID, $Attachment_count, $Attachment_array, $User_Name, $Ticket_ID, $Ticket_User){
            if($Attachment_count != 0){
                $UploadLocation = "./Assets/Uploads/" . $Ticket_ID . '_' . $Ticket_User . "/Response/";
                if(!is_dir($UploadLocation)){
                    mkdir($UploadLocation, 0755);
                }
                $UploadLocation = "./Assets/Uploads/" . $Ticket_ID . '_' . $Ticket_User . "/Response/" . $Ticket_Response_ID . '_' . $User_Name . "/";
                mkdir($UploadLocation, 0755);
                $File_ary = $this->reArrayFiles($Attachment_array);
                foreach ($File_ary as $File) {
                    $FileTarget = $UploadLocation . $File['name'];
                    move_uploaded_file($File['tmp_name'], $FileTarget);
                }
            }
            return true;
        }

        private function reArrayFiles(&$file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }

            return $file_ary;
        }

        public function BuildReactions($Ticket_ID, $Ticket_Username){
            $return_Reactions = "";

            $Get_Data = "SELECT * FROM ticket_response WHERE Ticket_Id=:id ;";
            $stmt = $this->PDO_CONNECTION->prepare($Get_Data);
            $stmt->execute(array(':id' => $Ticket_ID));
            $GetData_OUT = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($GetData_OUT as $ResponseData) {
                $Files_Text = "";
                $Unserialize_Array = unserialize($ResponseData['Response_Attachments']);
                if(!empty($Unserialize_Array[0])){
                    foreach ($Unserialize_Array as $file_Name) {
                        $Files_Text .= "<a download href='Assets/Uploads/".$Ticket_ID."_".$Ticket_Username."/Response/".$ResponseData['Response_id']."_".$ResponseData['Response_User']."/".$file_Name."'>".$file_Name."</a>" . "<br>";
                    }
                }

                $return_Reactions .= '
                <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                    <img src="Assets/IMG/user.webp" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0"><a href="mailto: '.$ResponseData['Response_Email'].'">'.$ResponseData['Response_User'].'</a></h6>
                            <p class="mb-0 opacity-75">'.$ResponseData['Response_Message'].'</p>
                            <p class="mb-0">'.$Files_Text.'</p>
                        </div>
                        <small class="opacity-50 text-nowrap">'. date("G:i - d/m/Y", strtotime($ResponseData['Response_DateTime'])) .'</small>
                    </div>
                </div>
                ';
            }

            return $return_Reactions;
        }
    }
?>