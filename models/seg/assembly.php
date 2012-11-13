<?php
namespace models\seg;
class Assembly extends \libs\Model {
    public $table = "assembly";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id = null){
       $ret = $this->insertSeg([$this->key,"p_id","step","step_num"],$id);
       echo $ret; 
    }
    function getAllData($p_id){
        $st = $this->db->query("SELECT assembly.p_id, assembly.id, assembly.step, assembly.step_num FROM assembly INNER JOIN product ON assembly.p_id = product.id WHERE assembly.p_id= '".$p_id."' ORDER BY assembly.step_num DESC");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function getData($id){
        $st = $this->db->query("SELECT assembly.id, assembly.p_id, assembly.step, assembly.step_num FROM assembly INNER JOIN product ON assembly.p_id = product.id WHERE assembly.id= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->db->query("DELETE FROM assembly WHERE `id` = '".$id."'");
    }
}