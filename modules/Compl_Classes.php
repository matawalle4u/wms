

<?php
    
    ini_set('display_errors', 1);



    interface NormalUsers {

        public  function login($username, $passw);
        public function get_previleges($user_id);
        public function get_notification($id, $type);
        public  function reset_password($username, $old, $new);
        public function logout();
        
        
    }

    interface SuperUsers {

        public function register($columns, $values);
        public function assign_previleges($assignee, $user, array $actions, array $menus);
        public function revoke_previlege($revoker, $user, $prev_name);
        public function update_previlege($updater, $user, $new_prev);

    }

    interface WareHouseAdmin {

        public function add_product();
        public function update_product();
        public function generate_report(); 
        public function assign_task_to_user();
        public function make_purchase_request();
        public function validate_request_supplier();


         //Organize sales put and validate Task on sales agents
        //With B2B Customer with Payment agreement and terms
        





    }

    interface CustomerB2B {

    }

    interface InvoiOrdProd {

        public function view_invoice();
        public function view_order_status();
        public function view_products_details();

    }



     class DataBase {

        private static $instance;
        public $database_obj;

        protected $host;
        protected $username;
        protected $password;
        protected $dbname;


        public function __construct(){

            $this->host = 'localhost';
            $this->username ='root';
            $this->password = '';
            $this->dbname = 'crm';

            $this->establish_conn();

            if (!isset(self::$instance)){
                self::$instance = $this;
                return self::$instance;
            }else{
                return self::$instance;
            }
        }


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

        
        public function put($table, array $columns, array $values){
            //"'{$name}'"

            //TODO make this prepared statement



            $put_flag = false;
            $cols = implode(',', $columns);
            $vals = implode(',', $values);

            $query  = "INSERT INTO $table ($cols) VALUES ($vals)";
            //echo"$query";

            $result = $this->database_obj->query($query);

            if($result==true){
                $put_flag = true;
            }

            return $put_flag;



        //     $put_flag = false;
        //     $data_types = '';
        //     $filtered_values =[];
        //     $question_marks ='';


        //     $rr =[];

        //     foreach ($values as $key => $value) {

        //         array_push($rr, "$$columns[$key]");
               
        //          if(gettype($value)=='integer'){
        //             $data_types .='i';
        //             //array_push($data_types, 'i');

        //             array_push($filtered_values, $value);

        //          }else{
        //            $data_types .='s';
        //            //array_push($data_types, 'i');
        //             array_push($filtered_values, "'{$value}'");
        //          }
                 
        //          $question_marks .=',?';
        //          //$data_types .=substr(gettype($value), 0,1);
    
        //     }

        //     $new_qs = substr($question_marks, 1);
        //     $dtyp = "'{$data_types}'";
        //     //echo "'{$dtyp}'" ."<br />";

        //     $cols = implode(',', $columns);
        //     $vals = implode(',', $filtered_values);
        //     $vals3 = implode(',', $rr);

        //     $explo = explode(',', $vals3);

        //    //$str = strlen($new_qs);
        //     //echo "<br />INSERT INTO $table ($cols) VALUES ($new_qs)";
        //     //echo "<br />".strlen($data_types), ':'. $vals ."<br />";

        //     $prepare_st = $this->database_obj->query("INSERT INTO $table ($cols) VALUES ($vals)");
        //     if($prepare_st){
        //         return true;
        //     }else{
        //         return false;
        //     }

            // echo "$dtyp, $vals3";
            // $prepare_st->bind_param($data_types, $email, $suna);
           
            
            // foreach ($explo as $key => $value) {
            //     # code...
            //     echo $value;
            //     //$value  == $values[$key];
            //    $email = 'makan@gmail.com';
            //    $suna = 'Kwadi';
            // }

            // $email = 'makan@gmail.com';
            // $suna = 'Kwadi';

           
            // $prepare_st->execute();
            // $prepare_st->close();

           
        }


        private function gen_conds(array $conditions, array $values){
            $query_cond ='';
            $counter=0;
            foreach($conditions as $co){
                if($counter==0){
                    $query_cond.='WHERE '.$co.'='."'$values[$counter]'";
                }else{
                    $query_cond.=' AND '.$co.'='."'$values[$counter]'";
                }
                $counter+=1;
            }
            return $query_cond;
        }


        public function get($table, array $columns, array $conditions, array $values, $limit){
            $this->establish_conn();
            $all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            $r =  $this->database_obj->query("SELECT DATABASE()");

            $row2 = $r->fetch_row();
            //echo "<h1>".$cond . " ".$this->host . " ". $this->username. " " .md5($this->password) . " ". $row2[0] ."</h1>";
           
            $result = $this->database_obj->query("SELECT  $cols FROM $table $cond");
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];    
                }
                array_push($all_ent, $group);
            }
            return $all_ent;
        }

        public function update($table, array $columns, array $values, array $conditions, array $cond_values){
            $counter = 0;
            $cond =$this->gen_conds($conditions, $cond_values);
            $coll='';
            foreach($columns as $col){
                if($counter==sizeof($columns)-1){
                    $coll.=' '.$col.'='."'$values[$counter]' ";
               }else{
               $coll.=' '.$col.'='."'$values[$counter]',";
               }
                $counter+=1;
            }
            //echo "UPDATE $table SET $coll $cond";
            $this->database_obj->query("UPDATE $table SET $coll $cond");
        }


        public function delete($table, array $conditions, array $cond_values){
            // 
            $cond =$this->gen_conds($conditions, $cond_values);

            $result =$this->database_obj->query("DELETE FROM $table $cond");
           
            // if($result->affected_rows >0){
            //     return true;
            // }else{
            //     return false;
            // }
            return $result;

        }
        
        
        public function join_get($table, $second_table, $first, $second , array $columns, array $conditions, array $values, $limit){
			
			$all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            
            $result =$this->database_obj->query("SELECT  $cols FROM $table INNER JOIN $second_table ON $first=$second $cond");
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];
                }
                array_push($all_ent, $group);
            }
			
            return $all_ent;
        }


        public function start_transaction(){
            return $this->database_obj->query("START TRANSACTION");
        }

        public function roll_or_commit($choise){

            return $this->database_obj->query($choise);
        }
        

        public function join_3_get($table, $second_table, $third_tbl, $first, $second,$third, array $columns, array $conditions, array $values, $limit){
			
			$all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            
            
            $result =$this->database_obj->query("SELECT  $cols FROM $table INNER JOIN $second_table ON $first=$second INNER JOIN $third_tbl ON $first=$third $cond");
           // 'racks', 'warehouses','warehouse_zones', 'racks.rack_id', 'warehouses.warehouse_id', 'warehouse_zones.zone_id',
            //`racks` INNER JOIN `warehouses` ON `racks.rack_id`= `warehouses.warehouse_id` INNER JOIN warehouse_zones ON 
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];
                }
                array_push($all_ent, $group);
            }
			
            return $all_ent;
		}
        
    }

    /*
    AUTHENTICATION MODULE

    */


    

    abstract class Auth extends DataBase {

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
            $result = $this->get($this->__auth_table, [$this->__auth_column], [$this->__auth_column, 'password','status'],[$user, $password, '1'], 'single');
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

    /*
    USERS CLASS

    */
 abstract class Users extends Auth implements NormalUsers {

     public function get_notification($id, $type){

     }

     public function update_user_info($user_table, $updater, array $columns, array $values, array $conditions, array $conditional_values){
         /*Get the user prevelages
         */
         $error_messages = array();
         $new_prevs = array();
         $new_vals = array();

         $prevs  = $this->get_previleges($updater);
         $i = 0;
         foreach($columns as $column){
             $operation = 'update_'.$column;
             if(in_array($operation, $prevs)){
                 array_push($new_prevs, $column);
                 array_push($new_vals, $values[$i]);
             }
             $i+=1;
         }

        if(!empty($new_prevs)){
            $update = $this->update($user_table, $new_prevs, $new_vals, $conditions, $conditional_values);
            if($update){
             //Success message front end
             return true;
            }else{
                //Err message Update failed  
            }
        }else{
            //User has empty preveleges to update  
        }

         //$this->update($this->__auth_table, $columns, $values, $conditions, $conditional_values);
     }
 }
 

 # No any other class can inherit from this class
 final class Admin extends SuperAuth implements SuperUsers {

     public function assign_previleges($assignee, $user, array $actions, array $menus){

         //TODO Check user status wether active or inactive
         $admin_prevs = $this->get_previleges($assignee);
         $flag = false;

         if(in_array(__FUNCTION__, $admin_prevs) ){

             $action =  implode(',', $actions);
             $menu = implode('', $menus);

             $columns = ['user', 'actions', 'assigner', 'user_menus'];
             $values = ["'$user'", "'$action'", "'$assignee'", "'$menu'"];

             $flag = $this->put('privelages', $columns, $values);
         }

        
         return $flag;
         
     }

     public function view_staffs(array $columns, array $conditions, array $values, $limit){

         $staffs = $this->get('staffs', $columns, $conditions, $values, $limit);
         return $staffs;

     }

     public function view_update_history($table, array $columns, array $conditions, array $values, $limit){

         return $this->get($table, $columns, $conditions, $values, $limit);
     }


     //Revoking user Privelge
     public function revoke_previlege($revoker, $user, $prev_name){
         //TODO Check user status wether active or inactive
         
         $user_privs = $this->get_previleges($user);
         $flag = false;

         if(in_array(__FUNCTION__, $this->get_previleges($revoker)) && in_array($prev_name, $user_privs) ){
             //TODO Remove some MENUS and Check Wether update is successful else repeat the process
             unset($user_privs[array_search($prev_name, $user_privs)]);
             $this->update('privelages', ['actions'], [implode(',',$user_privs)], ['user'], [$user]);
             $flag =true;
         }

         return $flag;

     }

     public function update_previlege($updater, $user, $new_prev){
         
         $user_privs = $this->get_previleges($user);
         if(in_array(__FUNCTION__, $this->get_previleges($updater)) && !empty($user_privs)){

             array_push($user_privs, $new_prev);
             $imploded = implode(',',$user_privs);
             if(substr($imploded, 0,1)==','){
                 $imploded = str_replace(',', '',$imploded);
             }

            $this->update('privelages', ['actions'], [$imploded], ['user'], [$user]); 
         }
     }
 }
 

 class WareHouseManager extends Users implements WareHouseAdmin {

    private function validate_contract(){}
     private function pay_staffs(){

     }
     private function make_sales_management(){ }//Organize sales put and validate Task on sales agents}
     private function implement_contract(){}


     public $warehouse_obj;
     public function __construct(){
         $this->warehouse_obj = new Warehouse();
     }
     //Only Implemented by Admin
     public function add_staff(array $columns, array $values){
         //Rules and Access rights for users
         $add = $this->put('staffs', $columns, $values);
         if($add){
             return true;
         }else{
             
             return false;
         }
     }
     
     

     //Implemented by both
     public function add_product(){}
     public function update_product(){}
     public function generate_report(){}
     public function assign_task_to_user(){}
     public function make_purchase_request(){}
     public function validate_request_supplier(){}



 }


 class WareHouseSupervisor extends WareHouseManager {

     /*
     
         private function view_shipping_orders(); // Views Shipping orders and progress
         private function process_orders(); //Wether to approve or Suspend
         private function makes_shipping_plan(); 
         prfunction view_reports_transaction(); //Expiry, Finished stock, Damaged etc. Sales Report
         privateivate function plan_request_supplier();
         private  function validate_item_list();

    
     */

     public function create_ware_zone(array $values){
         $flag  = false;
         $created  = $warehouse_obj->create_warehouse_zone($values);
         if($created){
             $flag = true;
         }

         return $flag;

     }

     

 }


 class SalesAgent extends Users implements InvoiOrdProd {
 /*
     private function make_sales();
     private function view_orders(); //Only Orders
     private function process_orders(); //Approve Update or cancel don't do B2B orders

     
 */

     public function view_invoice(){

     }

     public function view_order_status(){

     }

     public function view_products_details(){
         
     }

     


 }

 


 class Customers extends SalesAgent {

     //B2B and Website
 /*
     private function view_on_going_deals();

    
 */

 }

 class Driver extends Users {
     /*
         private function view_orders(); //Sees only orders associated with him. Can be implemented by Manager
         private function make_delivery(); 
         private function accept_cash_on_delivery();
         private function get_returnables(); //Return Un wanted goods or Pallets or Packages not paid
     */


 }

 class Picker extends Users {
     /*

     private function views_order(); //
     private function prepare_order(); //
     private function finish_order(); //Send to delivery que
     */
 }


 
?>