<?php

    /*
        Stock Rotation
        Notification
        Expiration date priority based on sales
        Stocking date priority on sales to avoid high renting fees
        Product search filter (Barcode, name, Product code)
        Staff Attendance record
        Courier System
    */

    ini_set('display_errors', 1);
    include('core/dbase.php');

    class WareHouse{
        
        private function generate_rack_code($warehouse_id, $){
            $code = $warehouse_id.$location.$position.
            return $code;
        }
        
    }
?>
