<?php

    ini_set('display_errors', 1);
    include('database.php');



   class Warehouse extends DataBase{


    private $warehouse_tbl = 'warehouses';
    private $zone_tbl = 'warehouse_zones';
    private $racks_tbl = 'racks';
    private $transfer_tbl = 'transfers';

    
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

$trr = $wh2->transfer([$product, $qty, $driver, $sender, $receiver, $transfer_docs]);

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





