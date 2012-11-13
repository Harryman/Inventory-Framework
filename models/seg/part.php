<?php
namespace models\seg;
class Part extends \libs\Model {
    public $table = "part";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id = null){
       $ret = $this->insertSeg([$this->key,"p_id","product_id","qty"],$id);
       echo $ret; 
    }
    function getAllData($p_id){
        $st = $this->db->query("SELECT product.qty AS product_qty, product.part_num, product.short_name,part.id, part.p_id, part.product_id, part.qty FROM part INNER JOIN product ON part.p_id = product.id WHERE part.p_id= '".$p_id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function getData($id){
        $st = $this->db->query("SELECT product.qty AS product_qty, product.part_num, product.short_name,part.id, part.p_id, part.product_id, part.qty FROM part INNER JOIN product ON part.p_id = product.id WHERE part.id= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->db->query("DELETE FROM part WHERE `id` = '".$id."'");
    }
}