<?php
ini_set('display_errors', 1);

include('database.php');
include('Time.php');

class Reports {

    /*

    Sales Report
    Purchase Report
    Staff Reports
    Product Report
    Overall Report




    */
    public $_sales_tbl;
    public $staff_tbl;
    public $products_tbl;

    public function __construct(){

        $db = new DataBase();
        $date_calc = new DateManip();
        print_r($db);
        print_r($date_calc);

    }

    public function get_sales_report();





}

$report = new Reports('You are testing');

?>