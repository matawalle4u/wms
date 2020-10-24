<?php

    ini_set('display_errors', 1);
    include('database.php');



   class Warehouse extends DataBase{


    private $warehouse_tbl = 'warehouses';
    private $zone_tbl = 'warehouse_zones';
    private $racks_tbl = 'racks';
    private $transfer_tbl = 'transfers';
    private $stocks_tbl = 'stocks';
    private $product_tbl = 'products';
    private $damage_tbl = 'damages';

    
    public function create_ware_house(array $values){

        $columns = array(
            'warehouse_name',
            'warehouse_address'
        );

        $create = $this->put($this->warehouse_tbl, $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    public function create_warehouse_zone(array $values){

        $columns = array(
            'zone_name',
            'zone_warehouse'
        );

        $create = $this->put($this->zone_tbl, $columns,$values);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    public function create_stock(array $values){

        $columns = array(
            'product',
            'rack',
            'quantity',
            'status'
        );

        //$create = $this->put($this->stocks_tbl, $columns,$values);
        $product = $values[0];
        $rack = $values[1];
        $new_qty = $values[2];

        $create=0;
        //If the stock doesnt exist it should add new entry
        $stocks = $this->get($this->stocks_tbl, ['product', 'quantity'], ['product', 'rack'], [$product, $rack], 'single');
        //print_r($stocks);
        if(!empty($stocks)){
            //It exists update the quantity
            $this->update($this->stocks_tbl, ['quantity'], [$new_qty+$stocks[0]['quantity']], ['product', 'rack'], [$product, $rack]);
        }else{
            //Doesnt exists make new entry
            $this->put($this->stocks_tbl, $columns,$values);
            
        }


    }




    public function create_rack(array $values){
        $columns = array(
            'rack_warehouse',
            'rack_zone',
            'rack_row',
            'rack_column',
            'rack_level',
            'rack_position'
        );
        print_r($columns);

        $create = $this->put($this->racks_tbl, $columns, $values);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    public function update_warehouse_zone(array $columns, array $values, array $conds, array $conds_vals){
        $flag  = false;
        $update = $this->update($this->zone_tbl, $columns, $values, $conds, $conds_vals);
        if($update){
            $flag= true;
        }

        return $flag;
    }

    public function update_warehouse(array $columns, array $values, array $conds, array $conds_vals){
        $update = $this->update($this->warehouse_tbl, $columns, $values, $conds, $conds_vals);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    public function update_rack(array $columns, array $values, array $conds, array $conds_vals){
        $update = $this->update($this->racks_tbl, $columns, $values, $conds, $conds_vals);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    


    public function view_rack(array $columns, array $conditions, array $values, $limit){

        //Warehouse Zone

        //$racks = $this->join_get('racks', 'warehouses', 'racks.warehouse', 'warehouses.warehouse_id', $columns, $conditions, $values, $limit);
        $racks = $this->join_3_get('racks', 'warehouses','warehouse_zones', 'racks.rack_id', 'warehouses.warehouse_id', 'warehouse_zones.zone_id', $columns, $conditions, $values, $limit);
        

        //$racks = $this->get($this->racks_tbl, $columns, $conditions, $values, $limit);
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


    public function tee_test($values){

        $columns = array("email", "suna");

        //print_r($this->database_obj);autocommit(FALSE);
        //$this->database_obj->begin_transaction();

        $insert  = $this->put('tee', $columns, $values);

        if($insert){
            return true;
        }else{
            return false;
        }
        

    }

    public function transfer(array $values){
        $columns = array(

            'product',
            'quantity',
            'driver',
            'sender',
            'receiver',
            'transfer_docs'
        );

        //Wrap the two in a transaction

        //$this->database_obj->query("START TRANSACTION");
        $transfer  = $this->put($this->transfer_tbl, $columns, $values);
        
        if($transfer){
            //this should affect the two warehouses
            return true;
        }else{
            return false;
        }

        //$this->roll_or_commit("COMMIT");
    }

    public function update_transfer(array $columns, array $values, array $conds, array $conds_vals){

        //Update the warehouse

        $update = $this->update($this->transfer_tbl, $columns, $values, $conds, $conds_vals);
        if($update){
            return true;
        }else{
            return false;
        }
    
    }

    public function delete_transfer(array $conds, array $conds_vals){
        $this->delete($this->transfer_tbl, $conds, $conds_vals);


    }

    public function delete_rack($rack_id){
        //check if the rack has product we delete else
        $product = $this->get($this->stocks_tbl, ['quantity'], ['rack'], [$rack_id], 'single');
        if(!empty($product)){
            $quantity = $product[sizeof($product)-1]['quantity'];
            if($quantity<1){
                //You can delete
                $deleted = $this->delete($this->racks_tbl,['rack_id'], [$rack_id]);
                return $deleted;
            }else{
                //You cannot delete
                return false;
            }
        }else{
            $deleted = $this->delete($this->racks_tbl,['rack_id'], [$rack_id]);
            return $deleted;
        }
    }

    public function record_damage($product, array $values){
        //upload the image given
        $columns = array(
            'product',
            'quantity',
            'details',
            'img_src'
        );

        $record  = $this->put($this->damage_tbl, $columns, $values);
        if($record){
            //reduce the stock
            //Stock reduced already by trigger set
            return true;
        }

    }




   }

$wh = new Warehouse();
  


//$zones = $wh->view_warehouse_zone(['zone_name','zone_id', 'zone_warehouse'], [], [], 'many');
//$wh = $wh->view_warehouse(['warehouse_name','warehouse_id', 'warehouse_address'], [], [], 'many');



?>






