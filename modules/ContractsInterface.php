<?php

     header('Content-Type:application/json');

    ini_set('display_errors', 1);
    include_once 'rest.php';

    

    $crm = new Request("crm/erp.php", ["name"]);
    $re = $crm->req();
   
    //echo $re['name'];
    //$crm->get_items();

?>
