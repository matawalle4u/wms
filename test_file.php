<?php
#https://linkedin.com/pulse/what-main-user-roles-warehouse-management-system-erhan-musaoglu
# https://www.logiwa.com/
# https://www.linkedin.com/today/author/erhanmusaoglu?trk=author-info__article-link Rack usefulness
    
# https://www.logiwa.com/warehouse-management-system-features
# FrontEnd, BackEndDeveloper, Database Designer, System Analyst, Project Management

//include('modules/Users.php');

/*
    Testing for authentication
*/

// class Tests extends Auth {
//     public function test_login(){

//     }
// }

// $a = new Tests('', '');

?>

<form method="post" action="" ENCTYPE="multipart/form-data">

   <input name="file" type="file" reuired>            
             
    <input type="submit" class="btn btn-block btn-primary" value="Upload" name="upload">
    

</form>

<?php
include('modules/utils.php');
date_default_timezone_set('Africa/Lagos');
echo date("Y.m.d");
if(isset($_POST['upload'])){
    //$file  = $_POST['file'];

    $util = new Utils();

    //$file_types = array("image/jpg", "image/png", "image/jpeg");

    $util->upload('file', "Daniel_Popa", 'Invoice', 'Mamar');
}

// $us = new Driver('tailors', 'phone', 'followup');

//     if(isset($_POST['login'])){

//         $phone = $_POST['phone'];
//         $pass = $_POST['password'];

//        // $login = 
//        $login = $us->login($_POST['phone'], $_POST['password']);
//        if($login){
//         echo"sxxx";
//        }else{
//            echo"err";
//        }
//     }else{

//     }

function Dan(){
    $previ = array("Dollar", "Dan", "Naira", "Euro");
    
    if(!in_array( __FUNCTION__, $previ)){
        echo"You have no previlege";
    }else{
        echo"You can execute";
    }
}

// function make_order(array $items, array $quantity, array $prices){

//     //Conversion e.g 20 mangos makes one box, three boxes make one pallet
//     $mangoQty = 20;
//     $noBox =1;
//     $box = $mangoQty/$noBox;
//     echo"$box";
//     return $result;
    

// }
//make_order([], [], []);

?>
