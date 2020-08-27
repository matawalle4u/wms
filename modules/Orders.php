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
                $deeetailss = "products:rice;quantity:20;prices:20;selling_price:1;order_types:B2B;unit_measure:kg;product_id:5";
            */
            $unwanted_chars  = array("'",",","."," ");
            $columns = array('customer','details','order_status');
            $unavailables = array();
            

            $details = $this->decompose($values[1]);
            
            $products = $details[0];
            $quantities = $details[1];
            $prices = $details[2];
            $selling_price = $details[3];
            $order_type = $details[4];
            $unit = $details[5];
            $product_id = $details[6];


            foreach($products as $key2=>$value2){

                $item_id = str_replace($unwanted_chars, "",$product_id[$key2]);
                $item_qty = str_replace($unwanted_chars, "", $quantities[$key2]);
                $unit_mea = $unit[$key2];
                $item_name = $products[$key2];
                $order_ty = $order_type[$key2];
                $price = $prices[$key2];
                $selling_pri = $selling_price[$key2];
                
                

                $produ = $this->get('stocks', ['quantity'], ['product'], [$item_id], 'single');
                $line = "products:$item_name;quantity:$item_qty;prices:$price;selling_price:$selling_pri;order_types:$order_ty;unit_measure:$unit_mea;product_id:$item_id";

                if(!empty($produ)){
                    if($item_qty<$produ[0]['quantity']){
                        $put  = $this->put($this->orders_tbl, $columns, $values);
                        if($put==false){
                            //Could not process Other return to user
                        }
                    }else{

                        if($item_qty==$produ[0]['quantity']){
                            $put = $this->put($this->orders_tbl, $columns, $values);
                            if($put==false){
                                //Could not process Other return to user
                            }

                        }else{
                            
                            array_push($unavailables, $line);
                        }

                        //TODO implement Request logic here
                    }
                    
                }else{
                    array_push($unavailables, $line);
                }
            }

            return $unavailables;
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





        public function decompose($text){

            $decomposed = array();
            $details = explode(';', $text);

            foreach($details as $key=>$valu){
                $details = explode(':',$valu);
                
                foreach($details as $ord_key=>$ord_val){
                    $index = $details[0];
                    if($ord_key>0){
                        $content  = explode(',', $ord_val);
                        array_push($decomposed, $content);
                    }
                }

            }

            return $decomposed;
        }

    }

    
    $obj = new Orders();
    $customer = 1;

    $deeetailss = "products:rice;quantity:5000;prices:20;selling_price:1;order_types:B2B;unit_measure:kg;product_id:5";
    $values = ["'$customer'", "'$deeetailss'", "'Pending'"];
    $una = $obj->create_order($values);
    if(empty($una)){
        echo"Order Requested No any problem";
    }else{
        //print_r($una);
        //Trying to process each returned lined
        foreach($una as $lineKey=>$lineVal){
            //echo"$lineVal";


            $details = $obj->decompose($lineVal);

           

            //Products details array for every order
            $products = $details[0];
            $quantities = $details[1];
            $prices = $details[2];
            $selling_price = $details[3];
            $order_type = $details[4];
            $unit = $details[5];
            $product_id = $details[6];

            foreach($products as $key2=>$value2){

                echo"<br />$value2 ($unit[$key2])
                <input type=text name=$value2 value=$quantities[$key2]> <br />";
                //echo 'ID '.$product_id[$key2]. ' ' .$value2 . ' Qty '. $quantities[$key2]. ' Unit '. $unit[$key2].' ';
            }
        
        echo "<br />";




        }
    }



    $orders = $obj->get_order(['customer', 'details', 'order_status'], ['order_id'], ['7'], 'many');

    echo"
        <form method=post action=>
    ";

    //Iterate every order for its details
    foreach($orders as $key=>$value){

        $details = $obj->decompose($orders[$key]['details']);

        $customer  = $orders[$key]['customer'];
        $order_status = $orders[$key]['order_status'];

        //Products details array for every order
        $products = $details[0];
        $quantities = $details[1];
        $prices = $details[2];
        $selling_price = $details[3];
        $order_type = $details[4];
        $unit = $details[5];
        $product_id = $details[6];

        foreach($products as $key2=>$value2){

            echo"$value2 ($unit[$key2])
            <input type=text name=$value2 value=$quantities[$key2]> <br />";
            //echo 'ID '.$product_id[$key2]. ' ' .$value2 . ' Qty '. $quantities[$key2]. ' Unit '. $unit[$key2].' ';
        }
        
        echo "<br />";


    }

    echo"

    <input type=submit value=Update name=order_updated>
    
    </form>";

    

?>
