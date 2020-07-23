 <?php

    
    include('../interfaces/Users.php');
   include('auth.php');

    abstract class Users extends Auth implements NormalUsers {

        
        

        public function get_notification($id, $type){

        }
        
    }
    

    # No any other class can inherit from this class
    final class Admin extends SuperAuth implements SuperUsers {

        //public function create_user(){}
        public function assign_previleges($assignee, $user, array $actions, array $menus){
            $flag = false;
            $admin_prevs = $this->get_previleges($assignee);

            if(in_array(__FUNCTION__, $admin_prevs) ){

                $action =  implode(',', $actions);
                $menu = implode('', $menus);

                $columns = ['user', 'actions', 'assigner', 'user_menus'];
                $values = ["'$user'", "'$action'", "'$assignee'", "'$menu'"];

                $flag = $this->put('privelages', $columns, $values);
            }

           
            return $flag;
            
        }


        //Revoking user Privelge
        public function revoke_previlege($revoker, $user, $prev_name){
            $flag = false;
            $user_privs = $this->get_previleges($user);
           

            if(in_array(__FUNCTION__, $this->get_previleges($revoker)) && in_array($prev_name, $user_privs) ){

                unset($user_privs[array_search($prev_name, $user_privs)]);

                //TODO Remove some MENUS and Check Wether update is successful else repeat the process
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
       
        //Only Implemented by Admin
        private function add_ware_house_stafff(){ }
        private function validate_contract(){}
        private function pay_staffs(){}
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

    

    $a = new Admin("users", "phone", "crm");
   
    //$a->update_previlege(1, 3, "added_new");
    
?>