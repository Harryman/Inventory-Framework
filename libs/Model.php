<?php
namespace libs;
class Model {

	function __construct() {
		$this->db = new Database();
	}
        
        protected function getAll($table){
            $st = $this->db->prepare("SELECT * FROM ".$table." WHERE 1=1");
            $st->execute();
            return $st;
        }
        
        protected function getAllWhere($table, $where, $is, $order_by = NULL, $ASCDESC = "ASC"){
            if($order_by == NULL){
                $st = $this->db->prepare("SELECT * FROM ".$table." WHERE ".$where." = :is");
            }
            else{
                $st = $this->db->prepare("SELECT * FROM ".$table." WHERE ".$where." = :is ORDER BY ".$order_by." ".$ASCDESC);            
            }
            $st->execute([':is'=>$is]);
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
            $result = $st->fetch(\PDO::FETCH_ASSOC);
            return $result;
        }
        protected function getColWhere($col, $table, $where, $is){
            $st = $this->db->prepare("SELECT ".$col." FROM ".$table." WHERE ".$where."= :is");
            $st->execute([":is"=>$is]);
            $result = $st->fetch();
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
                    $upstr .= "`".$val."` = VALUES(`".$val."`) ,";
                    $exarr[$idx] = $_POST[$val];
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
            $result = json_encode($resutl);
            header('Content-Type: application/json');
            return $result;
        }
            
            protected function jsRemove($id){// figure this out later 
            
        }
}