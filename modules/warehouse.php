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

    public function create_warehouse_zone(array $values){

        $columns = array(
            'name',
            'warehouse'
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
            'warehouse',
            'zone',
            'row',
            'column',
            'level',
            'position',

        );
        $create = $this->put($this->racks_tbl, $columns,$values);
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


$zones = $wh->view_warehouse_zone(['name','zone_id', 'warehouse'], [], [], 'many');
$wh = $wh->view_warehouse(['name','warehouse_id', 'address'], [], [], 'many');



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

                var item = element['name'];
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
                var warehouse = element['warehouse'];
                document.write('<option value='+element['zone_id'] +'>'+ element['name'] + ' ' +warehouse + '</option>');
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

                var item = element['name'];
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

                var item = element['name'];
                var index = element['zone_id'];

                document.write('<option value='+index +'>'+ item +'</option>');
            }
        )
    </script>

</select>


<input type="number" name="row" placeholder="Enter row">
<input type="number" name="column" placeholder="Enter column">
<input type="text" name="level" placeholder="Enter Level">
<input type="text" name="position" placeholder="Enter position">
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
    $u = $wh2->update_warehouse_zone(['name'], ["$name"],['zone_id'], ["$zone_id"]);




}


if(isset($_POST['rack_created'])){

    $warehouse =$_POST['warehouse'];
    $zone =$_POST['zone'];
    $row =$_POST['row'];
    $column =$_POST['column'];
    $level =$_POST['level'];
    $position =$_POST['position'];
    echo $warehouse. $zone. $row .$column. $level.$position;
   
    $wh2->create_rack(["'$warehouse'", "'$zone'", "'$row'", "'$column'", "'$level'", "'$position'"]);
}
            

?>




