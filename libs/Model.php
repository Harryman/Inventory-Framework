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
        protected function jsRemove($id){// figure this out later 
            
        }
}