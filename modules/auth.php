<?php

    ini_set('display_errors', 1);
    include('database.php');

    Abstract class Auth extends DataBase {

        private static $instance;
        
        public $__auth_table;
        public $__auth_column;
		public $__dbname;
        
        
        public function __construct($table, $column, $dbname){
            //Users username 
            //Admins email 'admin' 'email' ''
            
            DataBase::__construct();
            $this->set_active_db($dbname);
            
            
            //echo "<h1>{$this->current_db}</h1>";
            
            $this->__auth_table = $table;
            $this->__auth_column = $column;
			$this->__dbname = $dbname;
            
            if (!isset(self::$instance)){

                self::$instance = $this;
                return self::$instance;
            
            }else{
                return self::$instance;
            }
        }

        public function authenticate($user, $password){
            $auth_flag = false;
            $result = $this->get($this->__auth_table, [$this->__auth_column], [$this->__auth_column, 'password'],[$user, $password], 'single');
            if($result){
                $auth_flag = true;
            }
            return $auth_flag;
        }


        public function login($user, $pass){
            if($this->authenticate($user, md5("'{$pass}'"))){
                //$this->session->session_set([$this->__auth_column, $this->__auth_table],[$user, $this->__auth_table]);
                return True;
            }else{
                return False;
            }
        }

        public function reset_password($username, $old, $new){
			
            $reset_flag = false;
            $old = md5("'{$old}'");
            $new = md5("'{$new}'");
			
            if($this->authenticate($username, $old)==true){
                $reset_flag = true;
                $this->update($this->__auth_table, ['password'],[$new],[$this->__auth_column,'password'],[$username, $old]);
            }
            return $reset_flag; 
        }

        public function get_previleges($id){

            $privs = $this->get('privelages', ['actions'], ['user'],[$id], 'single');
            if(!empty($privs)){
                $res = explode(',',$privs[sizeof($privs)-1]['actions']);
                
                return $res;
            }else{
                return [];
            }
            
        }

        public function redirect($page){
            echo"<script type='text/javascript'>window.location.href='$page';</script>";
        }

        public function logout(){
            session_destroy(); 
        }

          public function __destruct(){
            
          }   
    }

    Abstract class SuperAuth extends Auth{

        public function register($columns, $values){
            $ct=0;
            foreach($columns as $column){
                if($column=='password'){
                    $enc = md5($values[$ct]);
                    $values[$ct]="'{$enc}'";
                }	
            $ct+=1;
            }
            $reg = $this->put($this->__auth_table, $columns, $values);
			if($reg){
				return True;
			}else{
				return False;
			}
        }

    }



// $ha = md5("'a'");
// echo"$ha";
?>