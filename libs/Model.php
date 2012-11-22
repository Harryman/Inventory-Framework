<?php
namespace libs;
class Model {

	function __construct() {
		$this->db = new Database();
	}
        
        protected function getAll($table){
            $st = $this->db->query("SELECT * FROM ".$table." WHERE 1=1");
            $result = $st->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        
        protected function getAllWhere($table, $where, $is, $order_by = NULL, $ASCDESC = "ASC"){
            if($order_by == NULL){
                $st = $this->db->prepare("SELECT * FROM ".$table." WHERE ".$where." = :is");
            }
            else{
                $st = $this->db->prepare("SELECT * FROM ".$table." WHERE ".$where." = :is ORDER BY ".$order_by." ".$ASCDESC);            
            }
            $st->execute([':is'=>$is]);
            return $st->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        protected function getAllWhereLike($table, $where, $like){
            $like ="%".$like."%";
            $st = $this->db->prepare("SELECT * FROM ".$table." WHERE :where LIKE :like");
            $st->execute([":where"=>$where,":like"=>$like]);
            $result = $st->fetch(\PDO::FETCH_ASSOC);
            return $result;
        }
        
        protected function getColWhereLike($col,$table, $where, $like){
            $like ="%".$like."%";
            $st = $this->db->prepare("SELECT `".$col."` FROM ".$table." WHERE :where LIKE :like");
            $st->execute([":where"=>$where,":like"=>$like]);
            $result = $st->fetch(\PDO::FETCH_ASSOC);
            return $result;
        }
        protected function getCol($col,$table){
            $st = $this->db->prepare("SELECT ".$col." FROM ".$table." WHERE 1=1");
            $st->execute();
            $result = $st->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        protected function getColWhere($col, $table, $where, $is){
            $st = $this->db->prepare("SELECT ".$col." FROM ".$table." WHERE ".$where."= :is");
            $st->execute([":is"=>$is]);
            $result = $st->fetchAll(\PDO::FETCH_COLUMN);
            return $result;
            }
        protected function getAC($table,$label,$value,$like){
            $like = "%".$like."%";
            $st = $this->db->prepare("SELECT `".$label."`,`".$value."` FROM ".$table." WHERE `".$label."` LIKE :like");
            $st->execute([":like"=>$like]);
            $result = $st->fetchAll(\PDO::FETCH_ASSOC);
            $i = 0;
            foreach($result as $iter){
                $coded[$i]['label'] = $iter[$label];
                $coded[$i]['value'] = $iter[$value];
                $i++;
            }
            return json_encode($coded);
        }
        
        protected function insertSeg($col,$id = null){
            $colstr = "";
            $valstr = "";
            $upstr = "";
            foreach($col as $val){
                $colstr .= "`".$val."`,";
                $valstr .= "?,"; 
                if($col[0] != $val){
                    if($val == 'date'){
                        $exarr[$idx] = date("Y-m-d H:i:s"); 
                    }
                    else{
                        $upstr .= "`".$val."` = VALUES(`".$val."`) ,";
                        if(isset($_POST[$val])){
                            $exarr[$idx] = $_POST[$val];
                        }
                        else{
                            $exarr[$idx] = 0;
                            }
                    }
                    $idx++;
                }
                else{
                    $exarr[0] = $id;
                    $idx = 1;
                }
            }
            $colstr = rtrim($colstr,",");
            $valstr = rtrim($valstr,",");
            $upstr = rtrim($upstr,",");
            $query = "INSERT INTO `".$this->table."` (".$colstr.") VALUES(".$valstr.") ON DUPLICATE KEY UPDATE ".$upstr;
            $st = $this->db->prepare($query);
            $st->execute($exarr);
            $ret = $this->db->lastInsertId();
            return  $ret;
        }
            
        protected function getSeg($idField, $id){
            $st = $this->db->prepare("SELECT * FROM `".$this->table."` WHERE `".$idField."` = :id");
            $st->execute([":id"=>$id]);
            $result = $st->fetch(\PDO::FETCH_ASSOC);
            return $result;
        }
        protected function delSeg($idField, $id){
            $st = $this->db->prepare("DELETE FROM `".$this->table."` WHERE `".$idField."` = :id");
            $st->execute([":id"=>$id]);
        }
        function getNormalizedFILES(){ 
            $newfiles = array(); 
            foreach($_FILES as $fieldname => $fieldvalue) 
                foreach($fieldvalue as $paramname => $paramvalue) 
                    foreach((array)$paramvalue as $index => $value) 
                        $newfiles[$fieldname][$index][$paramname] = $value; 
            return $newfiles; 
        }
        
        function getNextId($table){
            $st = $this->db->query("SHOW TABLE STATUS LIKE '".$table."'");
            $row = $st->fetch(\PDO::FETCH_ASSOC);
            $nextId = $row['Auto_increment'];
            echo $nextId;
            return $nextId;
        }
        function unique($table,$col,$value){
            $st = $this->db->prepare("SELECT count(*) FROM `".$table."` WHERE `".$col."` = :val");
            $st->execute(['val'=>$value]);
            $rows = $st->fetch(\PDO::FETCH_NUM);
            echo $rows[0];
            return $rows[0];
        }
}