<?php
namespace models\seg;
class Category extends \libs\Model {
    public $table = "category";
    public $key = "cat_id";
    function __construct() {
        parent::__construct();
    }
    
/*    function getCats(){
        $bottom = $this->db->query("SELECT `level` FROM category ORDER BY `level` DESC");
        $bottom = $bottom->fetch(\PDO::FETCH_NUM);
        $inc = 0;
        while($bottom[0] >= $inc){
            $parent = $this->db->query("SELECT * FROM category WHERE `level` = '".$inc."'");
            $levels[$inc] = $parent->fetchAll(\PDO::FETCH_ASSOC);
            $inc++;
        }
        header('Content-Type: application/json');
        echo json_encode($levels,JSON_FORCE_OBJECT);
        return $levels;
    }  
  function getParents($parent_id){
        $go = 15;
        while($go > 0 ){
            if($go == 15){
                $par = $this->getAllWhere($this->table, "id", $parent_id);
            }
            else if(!isset($par['parent_id'])){
                $par = $this->getAllWhere($this->table, "id", $par[0]['parent_id']);
            }
            if(isset($par[0]['level'])){
                $par['level'] = 0;
            }
            $lev = $par[0]['level'];
            $out[$lev] = $par;
            $go = $lev;
        }
        header('Content-Type: application/json');
        echo json_encode($out,JSON_FORCE_OBJECT);
        return $out;
    }*/
    function insert($id){
       $ret = $this->insertSeg([$this->key,"name","description","level","parent_id"],$id);
       echo $ret; 
       return $ret;
    }
    function get($id){
        $ret = $this->getSeg($this->key, $id);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->delSeg($this->key, $id);
    }
    function getFkey($fkey,$encode=TRUE){
        $ret = $this->getAllWhere( "category", "parent_id", $fkey);
        if($encode){
            header('Content-Type: application/json');
        echo json_encode($ret,JSON_FORCE_OBJECT);
        }
        return $ret;
    }
    function getParents($id,$encode=TRUE){
        $st = $this->db->prepare("SELECT * FROM category WHERE `id` = :id");
        $st->execute(["id"=>$id]);
        $parid = $st->fetch(\PDO::FETCH_ASSOC);
        $int = $parid['parent_id'];
        $out[] = [$parid['name']];
        while($int > 0){
            $st = $this->db->query("SELECT * FROM category WHERE id ='".$int."'");
            $ret = $st->fetch(\PDO::FETCH_ASSOC);
            $out[] = [$ret['name']];
            $int = $ret['parent_id'];
        }
        if($encode){
            header('Content-Type: application/json');
        echo json_encode($out,JSON_FORCE_OBJECT);
        }
        return $ret;
    }
}