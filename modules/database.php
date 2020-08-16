<?php
    require('../modules/Manifest.php');
    ini_set('display_errors', 1);

     class DataBase extends DatabaseManifest{

        //public $database_obj;
        //protected $current_db;
        private static $instance;


        public function __construct(){

            $this->establish_conn();

            if (!isset(self::$instance)){
                self::$instance = $this;
                return self::$instance;
            }else{
                return self::$instance;
            }
        }

        
        public function put($table, array $columns, array $values){
            //"'{$name}'"

            //TODO make this prepared statement
            $put_flag = false;
            $data_types = '';
            $filtered_values =[];
            $question_marks ='';


            $rr =[];

            foreach ($values as $key => $value) {

                array_push($rr, "$$columns[$key]");
               
                 if(gettype($value)=='integer'){
                    $data_types .='i';
                    //array_push($data_types, 'i');

                    array_push($filtered_values, $value);

                 }else{
                   $data_types .='s';
                   //array_push($data_types, 'i');
                    array_push($filtered_values, "'{$value}'");
                 }
                 
                 $question_marks .=',?';
                 //$data_types .=substr(gettype($value), 0,1);
    
            }

            $new_qs = substr($question_marks, 1);
            $dtyp = "'{$data_types}'";
            //echo "'{$dtyp}'" ."<br />";

            $cols = implode(',', $columns);
            $vals = implode(',', $filtered_values);
            $vals3 = implode(',', $rr);

            $explo = explode(',', $vals3);

           //$str = strlen($new_qs);
            //echo "<br />INSERT INTO $table ($cols) VALUES ($new_qs)";
            //echo "<br />".strlen($data_types), ':'. $vals ."<br />";

            $prepare_st = $this->database_obj->query("INSERT INTO $table ($cols) VALUES ($vals)");
            if($prepare_st){
                return true;
            }else{
                return false;
            }

            // echo "$dtyp, $vals3";
            // $prepare_st->bind_param($data_types, $email, $suna);
           
            
            // foreach ($explo as $key => $value) {
            //     # code...
            //     echo $value;
            //     //$value  == $values[$key];
            //    $email = 'makan@gmail.com';
            //    $suna = 'Kwadi';
            // }

            // $email = 'makan@gmail.com';
            // $suna = 'Kwadi';

           
            // $prepare_st->execute();
            // $prepare_st->close();

           
        }


        private function gen_conds(array $conditions, array $values){
            $query_cond ='';
            $counter=0;
            foreach($conditions as $co){
                if($counter==0){
                    $query_cond.='WHERE '.$co.'='."'$values[$counter]'";
                }else{
                    $query_cond.=' AND '.$co.'='."'$values[$counter]'";
                }
                $counter+=1;
            }
            return $query_cond;
        }


        public function get($table, array $columns, array $conditions, array $values, $limit){
            $this->establish_conn();
            $all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            $r =  $this->database_obj->query("SELECT DATABASE()");

            $row2 = $r->fetch_row();
            //echo "<h1>".$cond . " ".$this->host . " ". $this->username. " " .md5($this->password) . " ". $row2[0] ."</h1>";
           
            $result = $this->database_obj->query("SELECT  $cols FROM $table $cond");
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];    
                }
                array_push($all_ent, $group);
            }
            return $all_ent;
        }

        public function update($table, array $columns, array $values, array $conditions, array $cond_values){
            $counter = 0;
            $cond =$this->gen_conds($conditions, $cond_values);
            $coll='';
            foreach($columns as $col){
                if($counter==sizeof($columns)-1){
                    $coll.=' '.$col.'='."'$values[$counter]' ";
               }else{
               $coll.=' '.$col.'='."'$values[$counter]',";
               }
                $counter+=1;
            }
            $this->database_obj->query("UPDATE $table SET $coll $cond");
        }


        public function delete($table, array $conditions, array $cond_values){
            // 
            $cond =$this->gen_conds($conditions, $cond_values);
            $result =$this->database_obj->query("DELETE FROM $table $cond");
            //echo "DELETE FROM $table $cond";
            if($result->num_rows_affected >0){
                echo "Done";
            }else{
                echo "No";
            }

        }
        
        
        public function join_get($table, $second_table, $first, $second , array $columns, array $conditions, array $values, $limit){
			
			$all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            
            $result =$this->database_obj->query("SELECT  $cols FROM $table INNER JOIN $second_table ON $first=$second $cond");
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];
                }
                array_push($all_ent, $group);
            }
			
            return $all_ent;
        }


        public function start_transaction(){
            return $this->database_obj->query("START TRANSACTION");
        }

        public function roll_or_commit($choise){

            return $this->database_obj->query($choise);
        }
        

        public function join_3_get($table, $second_table, $third_tbl, $first, $second,$third, array $columns, array $conditions, array $values, $limit){
			
			$all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            
            
            $result =$this->database_obj->query("SELECT  $cols FROM $table INNER JOIN $second_table ON $first=$second INNER JOIN $third_tbl ON $first=$third $cond");
           // 'racks', 'warehouses','warehouse_zones', 'racks.rack_id', 'warehouses.warehouse_id', 'warehouse_zones.zone_id',
            //`racks` INNER JOIN `warehouses` ON `racks.rack_id`= `warehouses.warehouse_id` INNER JOIN warehouse_zones ON 
            while($row=$result->fetch_array()){
                $group = array();
                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];
                }
                array_push($all_ent, $group);
            }
			
            return $all_ent;
		}
        
    }

    class Dele extends DataBase {

        public function truct(){

            //$sql = new mysqli($this->host, $this->username, $this->password, 'crm');
            //$this->establish_conn();
            //parent::__construct();
            //DataBase::__construct();

            $r =  $this->database_obj->query("SELECT DATABASE()");

            $row2 = $r->fetch_row();
            echo "<h1>sss ".$row2[0] ."</h1>";

            $r  = $this->get('users', ['name', 'phone'], ['phone'],["2349028163380"], 'many');
            print_r($r);

        }

        
        
    }

$d = new Dele();
//$d->truct();




?>