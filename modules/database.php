<?php
    require('../modules/Manifest.php');

    Abstract class DataBase extends DatabaseManifest{

        public $database_obj;
        protected $current_db;

        public function __construct(){
            $this->database_obj = $this->establish_conn();
            $this->current_db = NULL;
        }


        public function create_or_del($operation, $name){
            $newname = "`{$name}`";

            //TODO if operation is CREATE check wether db exists
            $execute = $this->database_obj->query("$operation DATABASE $newname");
            if($execute){

                //connect to the the database created and select it
                $this->database_obj = new mysqli($this->host, $this->username, $this->password, $name);
                $this->database_obj->select_db($name);

                return true;
            }else{
                return false;
            }
            
        }

        public function get_active_db(){
            $result = $this->database_obj->query("SELECT DATABASE()");
            if($result){
                $row = $result->fetch_row();
                $this->current_db= $row[0];
                $result->close();
                return $this->current_db;
            }else{
                return false;
            }
        }


        public function set_active_db($name){


            // TODO check if DB Exists before setting to avoid error

            //$this->database_obj->select_db($name);
            $this->current_db = $name;
            $this->database_obj = new mysqli($this->host, $this->username, $this->password, $this->current_db);
            
            return $this->database_obj;

        }


        public function put($table, array $columns, array $values){
            //"'{$name}'"

            //TODO make this prepared statement
            $put_flag = false;
            $cols = implode(',', $columns);
            $vals = implode(',', $values);

            $result = $this->database_obj->query("INSERT INTO $table ($cols) VALUES ($vals)");

            if($result==true){
                $put_flag = true;
            }

            return $put_flag;
        }


        public function get($table, array $columns, array $conditions, array $values, $limit){
            $all_ent = array();
            $cols = implode(',', $columns);
            $cond =$this->gen_conds($conditions, $values);

            if($limit !='many'){
                $cond.=' LIMIT 1';
            }

            
            $result = $this->database_obj->query("SELECT  $cols FROM $table $cond");

            while($row=$result->fetch_array()){

                $group = array();

                for($i=0; $i<=sizeof($columns)-1; $i++){
                    $group[$columns[$i]] = $row[$columns[$i]];
                    //$entri  = $row[$columns[$i]];
                }
                array_push($all_ent, $group);
            }
			
            return $all_ent;
            
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

        
        
    }
$d = new Dele();
/*
$dbs = array("", "", "", "", "");
$delet = $d->create_or_del('DROP', 'adam');
 */   

?>