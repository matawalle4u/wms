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
                Decompose the array and make complex analysis here

                ORDER Details format as below

                $details = "
                    products:rice,beans,Banana,Mango;
                    quantity:2,3,47,99;
                    prices:20,30,40,50;
                    selling_price:1,2,3,4;
                    orders:B2B,SalesAgent,Website,Shop
                ";

                Implode and explode functions are applied for usage 


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





        public function decompose($order){

            $decomposed = array();
            $details = explode(';', $order['details']);

            foreach($details as $key=>$valu){
                $details = explode(':',$valu);
                
                foreach($details as $ord_key=>$ord_val){
                    $index = $details[0];
                    if($ord_key>0){
                        $content  = explode(',', $ord_val);
                        //$result[$index] = $content;
                        array_push($decomposed, $content);
                        
                        // echo "Key => ".$index ." ";
                        // print_r($content);
                        // echo "<br />";

                    }
                }

            }

            //print_r($result[4]);
            //print_r($result['quantity']);
            //echo $result['products'];
            return $decomposed;


        }


    }

    
    $obj = new Orders();
    $customer = 1;
    $values = ["'$customer'", "'Details Goes here'", "'B2B'"];
    //$order->create_order($values);



    $orders = $obj->get_order(['customer', 'details', 'order_status'], [], [], 'many');

    foreach($orders as $key=>$value){
        $details = $obj->decompose($orders[$key]);
        print_r($details[1]);
        echo "<br />";

    }


    $obj->update_order(['order_status'], ['Cancelled'], ['order_id'], ['1']);

    //$obj->delete_order(['order_id'], ['5']);

    // $ord = explode(':',$orders[0]['details']);
    // foreach($ord as $key=>$value){
    //     echo $value .' ';
    // }


?>
