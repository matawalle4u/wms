<?php

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


?>
