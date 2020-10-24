<?php

    include('warehouse.php');

    class Orders extends Warehouse{

        private $orders_tbl = 'orders';

        public function create_order(array $values){

            $return;
            $columns = array('customer','details','order_status');
            
            $unavailables = $this->check_qty_details($values[1]);
            if(empty($unavailables)){
                $return =  $this->put($this->orders_tbl, $columns, $values);
            }else{
                $return = $unavailables;
            }

            return $return;
        }

        public function get_order(array $columns, array $conditions, array $values, $limit){
            $orders = $this->get($this->orders_tbl, $columns, $conditions, $values, $limit);
            return $orders;
        }


        public function check_qty_details($details){

            $unwanted_chars  = array("'",",","."," ");
            $columns = array('customer','details','order_status');
            $unavailables = array();

            $details = $this->decompose($details);
            
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
                    if($item_qty>$produ[0]['quantity']){
                        
                        array_push($unavailables, $line);
                    }
                }else{
                    array_push($unavailables, $line);
                }
            }
            return $unavailables;
        }

        public function update_order(array $columns, array $values, array $conds, array $conds_vals){

            $flag = 0;
            if(in_array('details', $columns)){
                $unav = $this->check_qty_details($values[array_search('details', $columns)]);
                if(empty($unav)){
                    $this->update($this->orders_tbl, $columns, $values, $conds, $conds_vals);
                    $flag = 1;
                }
            }else{
                $this->update($this->orders_tbl, $columns, $values, $conds, $conds_vals);
                $flag = 1;
            }
            return $flag;
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

    //$obj = new Orders();
    

?>
