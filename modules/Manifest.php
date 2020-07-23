<?php

    include('../interfaces/Manifest.php');

    class DatabaseManifest implements DatabaseManifestInterface {

        //TODO make this an array with keys

        public $mysqli;
        protected $host = 'localhost';
        protected $username = 'root';
        protected $password = '';
        
        public function establish_conn(){
            $this->mysqli =  new mysqli($this->host, $this->username, $this->password);
            return $this->mysqli;
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
