<?php

ini_set('display_errors', 1);

include('database.php');



abstract class NormalProducts extends DataBase{
    //public $product_table;
    public $product_table = 'products';

    /*
        view_products
        add_products
        edit_products
        delete_products
        view_history

    */

    public function add_product(array $columns, array $values){
        
        $add = $this->put($this->product_table, $columns, $values);
        if($add){
            return true;
        }else{
            return false;
        }
    }

    public function view_product(array $columns, array $conditions, array $values, $limit){
        $products = $this->get($this->product_table, $columns, $conditions, $values, $limit);
        return $products;
    }

    public function get_av_sell_days($product_id, $starting, $ending){
        //print_r($this->database_obj);
        $q = $this->database_obj->query("SELECT sales_id FROM sales WHERE product='$product_id' AND (sales_date BETWEEN '$starting' AND '$ending') ");
        //print_r($q);
        echo $q->num_rows;
        while($row = $q->fetch_array()){


        }

    }

}

abstract class Consumables{

    /*
    private function search_product()
    private function expire();
    private function product_history(); //Supplier and Everything associated with that Product
    */

    //Track Expiry


   }

   abstract class BuildingMaterials{
       /*




       */
   }

   class Services{

        /*

        Transportation


        */




   }

   class Test extends NormalProducts{

   }

   $prd = new Test();
   $prd->get_av_sell_days(6, '2020-01-01', '2020-02-02');

    
?>
