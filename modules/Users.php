 <?php
    include('../interfaces/Users.php');
    include('auth.php');
    include('warehouse.php');



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

        public $warehouse_obj = new Warehouse();
       
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
        private function validate_contract(){}
        private function pay_staffs(){

        }
        private function make_sales_management(){ }//Organize sales put and validate Task on sales agents}
        private function implement_contract(){}
        

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

    

    // $dri = new Driver("users", "phone", "crm");
    // $col = ['staff_code', 'first_name', 'last_name', 'identity_card', 'role', 'dept', 'phone', 'email', 'address', 'img_src', 'status'];
    // $vas = ["'test_Code102'", "'Popa Adam'", "'Daniel'", "'890988'", "'Manager'", "'Production'", "'09023467777'", "'matawallepopa@gmail.com'", "'Romania'", "'uploads/logo.png'", "'1'"];
    // $mana = new WareHouseManager("users", "phone", "crm");
    // $mana->add_staff($col, $vas);


    //$mana->view_update_history('user_updates', ['updater', 'update_user'], [], [], 'many');



    //$dri->update_user_info(1, ['name', 'role'], ["DDDDD Adam", "Deve"], ['phone'], ["2349028163380"]);
    //update_user_info(array $columns, array $values, array $conditions, array $conditional_values)
    
    // $lo = $dri->login("2349028163380", "as");
    // if($lo){
    //     echo 1;
    // }

    //$a = new Admin("users", "phone", "crm");
   
    //$a->update_previlege(1, 3, "added_new");
    //$dri = new Driver("users", "phone", "crm");
    //$lo = $dri->login("2349028163380", "a");
   

    //$wman = new WareHouseManager("users", "phone", "crm");
    //$wman->add_staff();
    

    $users = new Admin("users", "phone", "crm");
    // $hist  = $users->view_update_history('user_updates', ['updater', 'updated_user', 'update_time'], [], [], 'many');
   $dd = $users->view_staffs(['first_name', 'last_name', 'status'], ['role'], ["Manager"], 'single');
   
  foreach($dd as $va){
      echo $va['first_name']."<br />";
  }
    
?>



<!-- <script type="text/javascript">
    function tee(){
    var comp = <?php echo json_encode($hist);?>;
    for(var i=0; i<=comp.length-1; i++){
        document.write(comp[i]['update_time']+"<br />");
    }
    }
    //alert('hell');
    
</script> -->