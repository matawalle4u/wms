<?php
require_once 'excel.js';
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
echo "
<table border=1 id='headerTable'>
    <tr>
        <td>Name
        </td>
        <td>Daniel
        </td>
    </tr>
</table>
<a href=\"javascript:fnExcelReport()\"><img src=excel.png width=40px height=40px title=\"Import to Microsoft Excel\"/></a>
";
?>

<form method="post" action="" ENCTYPE="multipart/form-data">

   <!-- <input name="file" type="file" reuired>  

   <input type="radio" name="doc" value="invoice">Invoice
   <input type="radio" name="doc" value="receipt">Receipt     
             
    <input type="submit" class="btn btn-block btn-primary" value="Upload" name="upload">
     -->

</form>

<?php
include('modules/utils.php');
date_default_timezone_set('Africa/Lagos');


$test='/showname/0406741848                              : Real Coffee Sweeden
/showname/0406741849                              : Healthzone SE
/showname/16133663413                             : FREE
/showname/16133663414                             : RadioPlantes Canada
/showname/16133663417                             : Dealsoftoday.Eu Canada
/showname/16136995593                             : FREE
/showname/16136995594                             : Club White Smile Canada
/showname/16138007442                             : FREE
/showname/16138007547                             : Mybitwave.com Canada
/showname/16465596150                             : BABY
/showname/16465696956                             : FREE
/showname/16465696957                             : FREE
/showname/16467419944                             : Mybitwave.com UK
/showname/16469181975                             : FREE
/showname/21501350                                : SecureSurf.EU NO
/showname/21501351                                : FileCloud365 Norwegian
/showname/21501352                                : FREE
/showname/21501353                                : RadioPlantes Norwegian
';

$myRows= explode("\n", $test);


foreach( $myRows as $key => $value) {
    $pieces = explode(":", $value);

    $res = str_replace(' ', '', $pieces[1]); // replace whitespaces for valid names
    $$res = 1; // note the double dollar signs
    //echo $$res;
}

echo $$RealCoffeeSweeden+3 .'<br />';





//echo $test;

if(isset($_POST['upload'])){
    //$file  = $_POST['file'];

    $util = new Utils();

    //$file_types = array("image/jpg", "image/png", "image/jpeg");

    $doc = $_POST['doc'];

    $util->upload('file', "Daniel_Popa", $doc, 'Adam');
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
$f = "1";
echo gettype($f);

?>
