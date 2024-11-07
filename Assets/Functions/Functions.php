<?php
    class DB_Connection{
        public $PDO_CONNECTION;

        public $connection_error = False;
        public $connection_error_message = "";


        public function __construct(){
            $DatabaseHost = "localhost";
            $DatabaseUsername = "root"; // DB Username
            $DatabasePassword = "retmig"; // DB Password
            $DatabaseName = "php_ticketsystem";

            try {
                $this->PDO_CONNECTION = new PDO("mysql:host={$DatabaseHost};dbname={$DatabaseName}", $DatabaseUsername, $DatabasePassword);
            } catch (PDOException $e) {
                $this->connection_error = True;
                $this->connection_error_message = 'Connection failed: ' . $e->getMessage();
            }
        }

        public function prettyprint($arr){
            echo '<pre>';
                print_r($arr);
            echo '</pre>';
        }

        public function CheckError(){
            $ErrorGen = "";
    
            if($this->connection_error != False && $this->connection_error_message != ""){
                $ErrorGen = "
                <nav class='alert alert-danger' role='alert'>
                    <h4 class='alert-heading'>Something went wrong!</h4>
                    <hr>
                    <p class='mb-0'>".$this->connection_error_message."</p>
                </nav>
                ";
            }
    
            return $ErrorGen;
        }
    }
?>