<?php
    /*
    update_order(['order_status','details'], ['Gwaji',"$deeetailss"], ['order_id'], ['1']); working
    During order
    Order details format
    $deeetailss = "products:rice;quantity:20;prices:20;selling_price:1;order_types:B2B;unit_measure:kg;product_id:5";
    */
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
print_r($racks2);
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
//$wh2->create_stock([6, 11, 3, 'Damaged']); 
//$trr = $wh2->tee_test(["transact@", "AdamuDaniel"]);
// if($wh2->delete_rack(10)){
//     echo 'Done';
// }else{
//     echo 'failed';
// }



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
<?php

$orders = $obj->get_order(['customer', 'details', 'order_status'], ['order_id'], ['7'], 'many');

echo"
    <form method=post action=>
";

//Iterate every order for its details
foreach($orders as $key=>$value){

    $details = $obj->decompose($orders[$key]['details']);

    $customer  = $orders[$key]['customer'];
    $order_status = $orders[$key]['order_status'];

    //Products details array for every order
    $products = $details[0];
    $quantities = $details[1];
    $prices = $details[2];
    $selling_price = $details[3];
    $order_type = $details[4];
    $unit = $details[5];
    $product_id = $details[6];

    foreach($products as $key2=>$value2){

        echo"$value2 ($unit[$key2])
        <input type=text name=$value2 value=$quantities[$key2]> <br />";
        //echo 'ID '.$product_id[$key2]. ' ' .$value2 . ' Qty '. $quantities[$key2]. ' Unit '. $unit[$key2].' ';
    }
    
    echo "<br />";


}


$obj = new Orders();
    $customer = 1;

    $deeetailss = "products:rice,beans;quantity:500,20;prices:20,25;selling_price:1,3;order_types:B2B,Shop;unit_measure:kg,bag;product_id:5,5";
    $values = ["'$customer'", "'$deeetailss'", "'Pending'"];
    $una = $obj->create_order($values);
    if(empty($una)){
        echo"Order Requested No any problem";
    }else{
        //print_r($una);
        //Trying to process each returned lined
        foreach($una as $lineKey=>$lineVal){
            //echo"$lineVal";


            $details = $obj->decompose($lineVal);

           

            //Products details array for every order
            $products = $details[0];
            $quantities = $details[1];
            $prices = $details[2];
            $selling_price = $details[3];
            $order_type = $details[4];
            $unit = $details[5];
            $product_id = $details[6];

            foreach($products as $key2=>$value2){

                echo"<br />$value2 ($unit[$key2])
                <input type=text name=$value2 value=$quantities[$key2]> <br />";
                //echo 'ID '.$product_id[$key2]. ' ' .$value2 . ' Qty '. $quantities[$key2]. ' Unit '. $unit[$key2].' ';
            }
        
        echo "<br />";




        }
    }



?>