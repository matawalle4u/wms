<?php

    include('../interfaces/Manifest.php');

    class DatabaseManifest implements DatabaseManifestInterface {

        //TODO make this an array with keys

        public $database_obj;
        protected $host = 'localhost';
        protected $username = 'root';
        protected $password = '';
        protected $dbname = 'crm';
        
        
        public function create_or_del($operation, $name){
            $newname = "`{$name}`";

            //TODO if operation is CREATE check wether db exists
            $execute = $this->database_obj->query("$operation DATABASE $newname");
            if($execute){

                //connect to the the database created and select it
                $this->database_obj = new mysqli($this->host, $this->username, $this->password, $name);
                $this->database_obj->select_db($name);

                return true;
            }else{
                return false;
            }
            
        }

        public function get_active_db(){
            $result = $this->database_obj->query("SELECT DATABASE()");
            if($result){
                $row = $result->fetch_row();
                $this->current_db= $row[0];
                $result->close();
                return $this->current_db;
            }else{
                return false;
            }
        }

        public function set_active_db($name){
            // TODO check if DB Exists before setting to avoid error
            $this->dbname = $name;
            $this->database_obj = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        }

        public function establish_conn(){
            $this->database_obj =  new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if(!$this->database_obj){
                throw new Exception('Could not connect');
            }

            //return $this->database_obj;
        }

        /*
        public $upload_dir = '../uploads';

        public function __construct(){

            $this->app_name = '';
            $this->app_icon = '../icons/logo3.png';
            $this->currency ='RON';
            $this->username ='daniel';
            $this->host = 'localhost';
            $this->password = 'flimxy';
            $this->manifest = $this;

        }
        */

    }

    
   
    
?>
