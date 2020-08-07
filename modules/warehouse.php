<?php

    ini_set('display_errors', 1);
    include('database.php');


   class Warehouse extends DataBase{


    private $warehouse_tbl = 'warehouses';
    private $zone_tbl = 'warehouse_zones';
    private $racks_tbl = 'racks';

    
    public function create_ware_house(array $columns, array $values){

        $create = $this->put($this->warehouse_tbl, $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }

    }

    public function update_warehouse(array $columns, array $values, array $conds, array $conds_vals){
        $update = $this->update($this->warehouse_tbl, $columns, $values, $conds, $conds_vals);
        if($update){
            return true;
        }else{
            return false;
        }
    }



    public function create_warehouse_zone(array $columns, array $values){

        $create = $this->put($this->zone_tbl, $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    public function create_rack(array $columns, array $values){
        $create = $this->put($this->zone_tbl, $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }
    }


    public function view_rack(array $columns, array $conditions, array $values, $limit){

        $racks = $this->get($this->racks_tbl, $columns, $conditions, $values, $limit);
        return $racks;
        

    }

    public function view_warehouse(array $columns, array $conditions, array $values, $limit){

        $warehouses = $this->get($this->warehouse_tbl, $columns, $conditions, $values, $limit);
        return $warehouses;
    }

    public function view_warehouse_zone($columns, $conditions, $values, $limit){
        $zones = $this->get($this->zone_tbl, $columns, $conditions, $values, $limit);
        return $zones;
    }




   }

   $wh = new Warehouse();
   //$wh->create_ware_house(['name', 'address'], ["'Warehouse Iasi'", "'Iasi Nigeria Romania'"]);

   //$wh->update_warehouse(['name'], ["Updated Name 3333"], ['warehouse_id'],["3"]);
   //echo $wh->tables[0];
//    $www = $wh->view_warehouse(['name', 'address'], [], [], 'many');
//    echo $www[0]['name'];
//    echo "<br />". $www[1]['name'];
//    echo "<br />". $www[2]['name'];

//    $zon = $wh->create_warehouse_zone(['name', 'warehouse'], ["'Damage Zone'", "'3'"]);
//    if($zon){
//     echo 'sxxxx';
//    }


$z = $wh->view_warehouse_zone(['name', 'warehouse'], [], [], 'many');

echo $z[0]['name'];

?>
