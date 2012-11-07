<?php
namespace models\seg;
class TABLE extends \libs\Model {
    public $table = "TABLE";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg([$this->key,"p_id","product_id","qty"],$id);
       echo $ret; 
    }
    function get($id){
        $st = $this->db->query("SELECT `id` FROM TABLE WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->db->query("DELETE FROM TABLE WHERE `id` = '".$id."'");
    }
}