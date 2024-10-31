<?php
    require('Functions.php');
    class Create extends DB_Connection{
        public $error_Subject = "";
        public $error_Message = "";
        public $error_UserName = "";
        public $error_Email = "";
        public $error_SQL = "";
        public $error_WebsitePopup = "";

        public function ErrorMSG(){
            if(!empty($this->error_Subject) or !empty($this->error_Message) or !empty($this->error_UserName) or !empty($this->error_Email) or !empty($this->error_SQL)){
                $this->error_WebsitePopup.= '<div class="alert alert-danger" role="alert">An error has occurred! <br> Here is a list what went wrong:<ul>';
                if(!empty($this->error_Subject)){
                    $this->error_WebsitePopup.= "<li>".$this->error_Subject."</li>";
                }
                if(!empty($this->error_Message)){
                    $this->error_WebsitePopup.= "<li>".$this->error_Message."</li>";
                }
                if(!empty($this->error_UserName)){
                    $this->error_WebsitePopup.= "<li>".$this->error_UserName."</li>";
                }
                if(!empty($this->error_Email)){
                    $this->error_WebsitePopup.= "<li>".$this->error_Email."</li>";
                }
                if(!empty($this->error_SQL)){
                    $this->error_WebsitePopup.= "<li>".$this->error_SQL."</li>";
                }
                $this->error_WebsitePopup.='</ul>Thanks for understanding.</div>';
            }
            return $this->error_WebsitePopup;
        }
        
        public function CreateTicket($Ticket_Subject, $Ticket_Priority, $Ticket_Message, $Ticket_Attachments, $User_Name, $User_Email){
            $Attachments_serialized="";
            $result = false;
            //Check Data

            $this->CheckData_Subject($Ticket_Subject);
            $Ticket_Priority = $this->CheckData_Priority($Ticket_Priority);
            $this->CheckData_Message($Ticket_Message);
            $this->CheckData_USRName($User_Name);
            $this->CheckData_Email($User_Email);

            if(!empty($this->error_Subject) or !empty($this->error_Message) or !empty($this->error_UserName) or !empty($this->error_Email)){
                return $result;
            }
            else{
                //Upload Attachments!
                $Attachments_serialized = $this->PrepareAttachments($Ticket_Attachments);

                $INSERT_ARRAY = array(
                    ':Ticket_Subject' => $Ticket_Subject,
                    ':Ticket_Priority' => $Ticket_Priority,
                    ':Ticket_Message' => $Ticket_Message,
                    ':Ticket_Attachments' => $Attachments_serialized[1],
                    ':User_Name' => $User_Name,
                    ':User_Email' => $User_Email,
                );

                $Insert_Query= "INSERT INTO ticket (Ticket_Subject, Ticket_Priority, Ticket_Message, Ticket_Attachments, User_Name, User_Email) VALUES (:Ticket_Subject, :Ticket_Priority, :Ticket_Message, :Ticket_Attachments, :User_Name, :User_Email)";
                $stmt = $this->PDO_CONNECTION->prepare($Insert_Query);
                $SQL_Result = '';
                try{
                    if($stmt->execute($INSERT_ARRAY)){
                        $SQL_Result = $this->PDO_CONNECTION->lastInsertId();
                    }
                }catch(PDOException $e){
                    $this->error_SQL = "Error: " . $e->getMessage();
                }

                if(!empty($SQL_Result)){
                    if($this->UploadAttachments($SQL_Result, $Attachments_serialized[0], $Ticket_Attachments, $User_Name) == true){
                        $result = True;
                    }   
                }
            }
            
            return $result;
        }

/**
 * The function "CheckData_Subject" checks if the ticket subject is empty and sets an error message if
 * it is.
 * 
 * @param Ticket_Subject The parameter `` is the subject of a ticket.
 */
        private function CheckData_Subject($Ticket_Subject){
            if(empty($Ticket_Subject)){
                $this->error_Subject = "Ticket Subject is Empty!";
            }
        }

/**
 * The function checks if the given ticket priority is a valid number and returns it, otherwise it sets
 * it to 0.
 * 
 * @param Ticket_Priority The parameter Ticket_Priority is a variable that represents the priority of a
 * ticket. It is expected to be a numeric value.
 * 
 * @return the value of the variable  after performing some checks and modifications.
 */
        private function CheckData_Priority($Ticket_Priority){
            if(!preg_match('/^[0-9]+$/', $Ticket_Priority)){
                $Ticket_Priority = 0;
            }
            if(empty($Ticket_Priority)){
                $Ticket_Priority = 0;
            }
            return $Ticket_Priority;
        }

/**
 * The function "CheckData_Message" checks if the variable "Ticket_Message" is empty and sets an error
 * message if it is.
 * 
 * @param Ticket_Message The parameter `` is the message that needs to be checked for
 * emptiness.
 */
        private function CheckData_Message($Ticket_Message){
            if(empty($Ticket_Message)){
                $this->error_Message = "Message is Empty!";
            }
        }

/**
 * The CheckData_USRName function checks if the User_Name parameter is empty and sets an error message
 * if it is.
 * 
 * @param User_Name The parameter User_Name is the user name that needs to be checked for emptiness.
 */
        private function CheckData_USRName($User_Name){
            if(empty($User_Name)){
                $this->error_UserName = "User name is Empty!";
            }
        }

/**
 * The CheckData_Email function checks if the User_Email is empty and sets an error message if it is.
 * 
 * @param User_Email The parameter User_Email is the email address of the user that needs to be
 * checked.
 */
        private function CheckData_Email($User_Email){
            if(empty($User_Email)){
                $this->error_Email = "User Email is Empty!";
            }
        }

/**
 * The function "PrepareAttachments" takes an array of attachments and returns a serialized array
 * containing the count and names of the attachments.
 * 
 * @param Attachment_array An array containing information about the attachments. It has two keys:
 * 'name' and 'type'. The 'name' key holds an array of attachment names, and the 'type' key holds an
 * array of attachment types.
 * 
 * @return an array containing two elements. The first element is the count of the 'name' array in the
 *  parameter, and the second element is the serialized version of the 'name' array.
 */
        private function PrepareAttachments($Attachment_array){
            $ReturnValue = array();
            array_push($ReturnValue, count($Attachment_array['name']));
            array_push($ReturnValue, serialize($Attachment_array['name']));
            return $ReturnValue;
        }

/**
 * The reArrayFiles function reorganizes an array of files uploaded via a form into a multidimensional
 * array.
 * 
 * @param file_post An array containing information about uploaded files. It typically has the
 * following keys:
 * 
 * @return an array of files, where each file is represented as an associative array with keys 'name',
 * 'type', 'tmp_name', 'error', and 'size'.
 */
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

/**
 * The function `UploadAttachments` is used to upload attachments for a ticket in a PHP application.
 * 
 * @param Ticket_ID The Ticket_ID parameter is the unique identifier for the ticket. It is used to
 * create a unique folder for storing the attachments related to that ticket.
 * @param Attachment_count The number of attachments to be uploaded.
 * @param Attachment_array The  parameter is an array that contains the attachments to
 * be uploaded. Each element of the array represents a single attachment and contains information such
 * as the name, temporary location, and size of the file.
 * @param Ticket_User The Ticket_User parameter represents the user who is associated with the ticket.
 * 
 * @return a boolean value of true.
 */
        private function UploadAttachments($Ticket_ID, $Attachment_count, $Attachment_array, $Ticket_User){
            if($Attachment_count != 0){
                $UploadLocation = "./Assets/Uploads/" . $Ticket_ID . '_' . $Ticket_User . "/";
                mkdir($UploadLocation, 0755);
                $File_ary = $this->reArrayFiles($Attachment_array);
                foreach ($File_ary as $File) {
                    $FileTarget = $UploadLocation . $File['name'];
                    move_uploaded_file($File['tmp_name'], $FileTarget);
                }
            }
            return true;
        }
        
/**
 * The function returns a success message with a link to view a newly created ticket.
 * 
 * @return a string containing an HTML alert message. The message indicates that a ticket has been
 * created and provides a link to view the ticket.
 */

        public function SuccessMSG(){
            $LastID_PDO = $this->PDO_CONNECTION->lastInsertId();
            $ReturnValue = '<div class="alert alert-success" role="alert">
            <h1>Ticket Created!</h1>
            The ticket has been created, you can check out the ticket <a href="ticket_view.php?ticket_id='.$LastID_PDO.'">here</a>!
            </div>';

            return $ReturnValue;
        }
    }
?>