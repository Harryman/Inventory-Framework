<?php
namespace models\seg;
class Product extends \libs\Model {
    public $table = "product";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg([$this->key,"short_name","desc","qty","price","cost","location","ship_note","order_info","other_info","weight","jn_number","active","sold","date"],$id);
       echo $ret; 
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
    function getFkey($fkey){
        $ret = $this->getColWhere("CHILD ID", "CHILD TABLE", "FOREIGN KEY COLMN", $fkey);
        return $ret;
    }
}