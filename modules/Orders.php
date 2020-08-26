<?php

    include('warehouse.php');

    class Orders extends Warehouse{

        private $orders_tbl = 'orders';

        /*
            $obj->update_order(['order_status'], ['Cancel'], ['order_id'], ['1']); working
            1. Orders from shops (Problem comes when a customer)
            2. Orders from Websites
            3. Orders from B2B Platforms
            4. Orders from Sales Agent
        */

        //TODO
        /*
            Check the order work flow

        */

        public function create_order(array $values){

            /*

            Check whether the item is available


            */

            $columns = array(
                'customer',
                'details',
                'order_status'
            );

            $create = $this->put($this->orders_tbl, $columns, $values);
            if($create){
                return true;
            }else{
                return false;
            }
        }

        public function get_order(array $columns, array $conditions, array $values, $limit){
            $orders = $this->get($this->orders_tbl, $columns, $conditions, $values, $limit);
            return $orders;
        }

        public function update_order(array $columns, array $values, array $conds, array $conds_vals){
            $update = $this->update($this->orders_tbl, $columns, $values, $conds, $conds_vals);
            if($update){
                return true;
            }else{
                return false;
            }
        }


        public function delete_order(array $conds, array $conds_vals){
            $this->delete($this->orders_tbl, $conds, $conds_vals);
        }





        public function decompose_details($order){
            //
            $details = $order['details'];

            $ord = explode(';',$details);
            foreach($ord as $key2=>$valu){
                $ord2 = explode(':',$valu);
                echo $key2. ' ';
                print_r($ord2)."<br />";

            }


        }


    }

    
    $obj = new Orders();
    $customer = 1;
    $values = ["'$customer'", "'Details Goes here'", "'B2B'"];
    //$order->create_order($values);



    $orders = $obj->get_order(['customer', 'details', 'order_status'], [], [], 'many');

    foreach($orders as $key=>$value){
        $details = $obj->decompose_details($orders[$key]);

    }


    $obj->update_order(['order_status'], ['Cancel'], ['order_id'], ['1']);

    //$obj->delete_order(['order_id'], ['5']);

    // $ord = explode(':',$orders[0]['details']);
    // foreach($ord as $key=>$value){
    //     echo $value .' ';
    // }


?>
