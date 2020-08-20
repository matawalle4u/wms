<?php
//include('database.php');
include('warehouse.php');
ini_set('display_errors', 1);

   abstract class Sales extends Warehouse {

      
      //$this->database_obj
        private $sales_tbl='sales';
        private $stocks_tbl ='stocks';
       
       
       

       public function make_sales(array $values){

        $columns = array(
           'invoice',
           'seller',
           'product',
           'sold_qty',
           'order'
        );

        //$create_sale = $this->put($this->sales_tbl, $columns, $values);
         
         /* 
            1. make sales on check if we have the items in stock

         */

         $pro = $values[2];
         $qty = $values[3];

         //First check wether qty is enough
         $avail_qty = $this->get($this->stocks_tbl, ['quantity'], ['product'], [$pro], 'single');

         if(!empty($avail_qty)){

            $avail_qty = $avail_qty[0]['quantity'];
            //check if $avail_qty and $selling quantity
            if($avail_qty-$qty >=0){
               //After sales stock cannot be negative
               
               
               if($avail_qty-$qty == 0){
                  //If the remaining quantity is zero after sells initiate auto_request
                  //TODO Logic for the request comes here Preferably at sql level trigger
               }

               $insert = $this->put($this->sales_tbl, $columns, $values);
               if($insert){
                  return 1;
               }else{
                  return 0;
               }

               

            }else{
               //Quantity is too much
               return -1;
            }

         
         }else{
            //No such product with that id
            return -2;
         }

         

        
        



        
       }

   }

class B2BSales extends Sales{

}

class ShopSales extends Sales {

}

class ECommerceSales extends Sales {

}

$w = new ShopSales();
$s  = $w->make_sales(["123", "Adam", "5", "34", "1"]);
echo "$s";
?>
