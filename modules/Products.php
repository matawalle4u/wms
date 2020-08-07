<?php



abstract class NormalProducts extends DataBase{
    public $product_table;
    $this->product_table = 'products';

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

    public function view_product((array $columns, array $conditions, array $values, $limit){
        $products = $this->get(($this->product_table, $columns, $conditions, $values, $limit);
        return $products;
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


    
?>
