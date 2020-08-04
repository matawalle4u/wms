<?php
    require('../modules/Manifest.php');
    ini_set('display_errors', 1);

     class DataBase extends DatabaseManifest{

        //public $database_obj;
        //protected $current_db;


        public function __construct(){

            $this->establish_conn();
        }

        
        public function put($table, array $columns, array $values){
            //"'{$name}'"

            //TODO make this prepared statement
            $put_flag = false;
            $cols = implode(',', $columns);
            $vals = implode(',', $values);

            //echo $cols,$vals;
            

            $result = $this->database_obj->query("INSERT INTO $table ($cols) VALUES ($vals)");

            if($result==true){
                $put_flag = true;
            }

            return $put_flag;
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
            echo "<h1>".$cond . " ".$this->host . " ". $this->username. " " .md5($this->password) . " ". $row2[0] ."</h1>";
           
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
$d->truct();




?>