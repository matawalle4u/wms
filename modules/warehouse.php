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
  


$zones = $wh->view_warehouse_zone(['zone_name','zone_id', 'zone_warehouse'], [], [], 'many');
$wh = $wh->view_warehouse(['warehouse_name','warehouse_id', 'warehouse_address'], [], [], 'many');



//echo $z[0]['name'];
//echo $wh[0]['name'];

?>

<h1>Create Zone</h1>
<form action="" method="post">

WareHouse <select name="warehouse">
    <script>
        const names = <?php echo json_encode($wh); ?>;
        
        names.map(
            (element)=>{

                var item = element['warehouse_name'];
                var index = element['warehouse_id'];

                document.write('<option value='+index +'>'+ item +'</option>');
            }
        )
    </script>

</select>

<input type="text" name="name" placeholder="Name of the zone">
<input type="submit" name="submitted" value="Add">

</form>


<h1>Edit Zone</h1>

<form action="" method="post">

Zone <select name="zone">
    <script>
        
        const zones = <?php echo json_encode($zones); ?>;
        
        zones.map(
            (element)=>{
                var warehouse = element['zone_warehouse'];
                document.write('<option value='+element['zone_id'] +'>'+ element['zone_name'] + ' ' +warehouse + '</option>');
            }
        )
    </script>

</select>

<input type="text" name="name" placeholder="New zone name">


<input type="submit" name="editted" value="Add">

</form>

<h1>Create Rack</h1>
<form action="" method="post">

WareHouse <select name="warehouse">
    <script>
        const waree = <?php echo json_encode($wh); ?>;
        
        waree.map(
            (element)=>{

                var item = element['warehouse_name'];
                var index = element['warehouse_id'];

                document.write('<option value='+index +'>'+ item +'</option>');
            }
        )
    </script>

</select>


Zone <select name="zone">
    <script>
        const nam = <?php echo json_encode($zones); ?>;
        
        nam.map(
            (element)=>{

                var item = element['zone_name'];
                var index = element['zone_id'];

                document.write('<option value='+index +'>'+ item +'</option>');
            }
        )
    </script>

</select>


<input type="number" name="row" placeholder="Enter row">
<input type="number" name="column" placeholder="Enter column">
<input type="text" name="level" placeholder="Enter Level">


Position <select name="position">
    <script>
        const positions =['Left', 'Right', 'Middle'];
        positions.map(
            (elements)=>{
                document.write('<option value='+elements +'>'+ elements +'</option>'); 
            }
        )

        
    </script>

</select>



<input type="submit" name="rack_created" value="Create">

</form>




<?php 
$wh2 = new Warehouse();

//phpinfo();

//echo $_POST['warehouse'];
if(isset($_POST['submitted'])){
    $name = $_POST['name'];
    $warehouse = $_POST['warehouse'];

    $wh2->create_warehouse_zone(["'$name'", "'$warehouse'"]);

}

if(isset($_POST['editted'])){


    $zone_id = $_POST['zone'];
    $name = $_POST['name'];
    $u = $wh2->update_warehouse_zone(['zone_name'], ["$name"],['zone_id'], ["$zone_id"]);




}


if(isset($_POST['rack_created'])){

    $warehouse =$_POST['warehouse'];
    $zone =$_POST['zone'];
    $row =$_POST['row'];
    $column =$_POST['column'];
    $level =$_POST['level'];
    $position =$_POST['position'];
    echo 'Warehouse'.$warehouse. 'Zone'.$zone. 'Row'.$row .'Column'.$column.'Level'. $level. 'Position'.$position;
    $wh2->create_rack(["'$warehouse'", "'$zone'", "'$row'", "'$column'", "'$level'", "'$position'"]); 
}

$racks2 = $wh2->view_rack(['warehouse_name', 'zone_name', 'rack_zone', 'rack_row', 'rack_column', 'rack_level', 'rack_position'], [], [], 'many');

$product = 3;
$qty = 23;
$driver = 1;
$sender =3;
$receiver =5;
$transfer_docs = "The docs";
$id =45;
$time ='20/20/2020';


//$trr = $wh2->transfer([$product, $qty, $driver, $sender, $receiver, $transfer_docs]);
//$wh2->update_transfer(['quantity'], [8], ['sender', 'receiver', 'transfer_docs'], [3,5, 'docs']);
//$wh2->delete_transfer(['sender', 'receiver', 'transfer_docs'], [3,5, 'docs']);
$wh2->create_stock([5, 11, 7, 'Damaged']); 
//$trr = $wh2->tee_test(["transact@", "AdamuDaniel"]);
if($wh2->delete_rack(10)){
    echo 'Done';
}else{
    echo 'failed';
}


if($trr){
    echo"Sxxxx";
}else{
    echo"errr";
}
//Sale
?>



<script>
   
    const rac = <?php echo json_encode($racks2); ?>;
        
        rac.map(
            (element)=>{
               var wareh = element['warehouse_name'];
               var zon =element['zone_name'];
               var rw =element['rack_row'];
               var cl =element['rack_column'];
               var lvl =element['rack_level'];
               var potn =element['rack_position'];


               //THis is the sales destination of an item while making sales
                document.write('WareHouse: '+wareh + ' Zone :'+zon +' Row :'+rw +' Column :'+cl +' Level :'+lvl +' Position :' +potn +'<br />');
            }
    )
</script>





