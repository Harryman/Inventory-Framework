<?php
namespace models\seg;
class Category extends \libs\Model {
    public $table = "category";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function getCats(){
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
            var_dump($par);
            $lev = $par[0]['level'];
            $out[$lev] = $par;
            $go = $lev;
        }
        header('Content-Type: application/json');
        echo json_encode($out,JSON_FORCE_OBJECT);
        return $out;
    }
    
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
}