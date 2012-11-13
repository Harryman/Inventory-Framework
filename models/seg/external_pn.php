<?php
namespace models\seg;
class External_pn extends \libs\Model {
    public $table = "external_pn";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id = null){
       $ret = $this->insertSeg([$this->key,"p_id","external_pn","desc"],$id);
       echo $ret; 
    }
    function getAllData($p_id){
        $st = $this->db->query("SELECT external_pn.p_id, external_pn.id, external_pn.external_pn, external_pn.desc FROM external_pn INNER JOIN product ON external_pn.p_id = product.id WHERE external_pn.p_id= '".$p_id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function getData($id){
        $st = $this->db->query("SELECT external_pn.id, external_pn.p_id, external_pn.external_pn, external_pn.desc FROM external_pn INNER JOIN product ON external_pn.p_id = product.id WHERE external_pn.id= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->db->query("DELETE FROM external_pn WHERE `id` = '".$id."'");
    }
}