<?php

    ini_set('display_errors', 1);
    //date_default_timezone_set('Europe/Bucharest');
    date_default_timezone_set('Africa/Lagos');

    
    
    class Utils{

        private static $instance;
        public $upload_types;
        public $time_zone;
        
        public function __construct(){
            
            $this->upload_types = array(
                'image/jpg',
                'image/png',
                'image/jpeg'
            );
            
            //$this->time_zone  = date_default_timezone_set('Europe/Bucharest');

            if (!isset(self::$instance)){
                self::$instance = $this;
                return self::$instance;
            }else{
                return self::$instance;
            }
        }

        public function upload($fil, $unique_param){

            
            
            $h = date('g');
            $m = date('i');
            $s = date('s');

            $day = date('j');
            $month = date('M');
            $year =  date('Y');
            $format = date('a');

            $upload_flag=false;

            $month_year = $month.$year;

            $uploaddir = 'uploads/'.$month_year;
            
            $date = $day.$month . $year;

            $time = $date.$h.$m.$s.$format;
            $picN = $uploaddir.'/'.$month_year . ($time.$unique_param). '.'.array_pop(explode("/", $_FILES[$fil]['type']));
            

            $temp_file  = $_FILES[$fil]['tmp_name'];
            
            
            if(in_array($_FILES[$fil]['type'], $this->upload_types)) {

                if(file_exists('uploads/'.$month_year)){

                    //Push to the folder
                   if((move_uploaded_file($temp_file, $picN) )){

                        if(move_uploaded_file($temp_file, 'uploads/'.$month_year)){
                            $upload_flag = true;
                        }
                        
                    }

                    
                }else{
                   //Create the folder and push
                    mkdir('uploads/'.$month_year, 0777, true);

                    if((move_uploaded_file($_FILES[$fil]['tmp_name'], $picN) )){
                        $upload_flag = true;
                    }
                }
                
            }
        }

        
        public function __destruct(){
        }
    }
?>