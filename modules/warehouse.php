<?php

    ini_set('display_errors', 1);
    include('database.php');


   class Warehouse extends DataBase{

    private $tables = array(
        "warehouses",
        "warehouse_zones"
    );
   

    public function create_ware_house(array $columns, array $values){
        
        $create = $this->put($this->tables[0], $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }

    }

    public function update_warehouse(array $columns, array $values, array $conds, array $conds_vals){
        $update = $this->update($this->tables[0], $columns, $values, $conds, $conds_vals);
    }



    public function create_warehouse_zone(){

        $create = $this->put($this->tables[1], $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    public function create_rack(){

    }


    public function view_rack(){

    }

    public function view_warehouse(array $columns, array $conditions, array $values, $limit){
        $warehouses = $this->get($this->tables[0], $columns, $conditions, $values, $limit);
        return $warehouses;
    }

    public function view_warehouse_zone(){

    }




   }

   $wh = new Warehouse();
   //$wh->create_ware_house(['name', 'address'], ["'Warehouse Iasi'", "'Iasi Nigeria Romania'"]);

   //$wh->update_warehouse(['name'], ["Updated Name 3333"], ['warehouse_id'],["3"]);
   //echo $wh->tables[0];
   $www = $wh->view_warehouse(['name', 'address'], [], [], 'many');
   echo $www[0]['name'];
   echo "<br />". $www[1]['name'];
   echo "<br />". $www[2]['name'];

?>
