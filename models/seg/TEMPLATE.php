<?php
namespace models\seg;
class Document extends \libs\Model {
    public $table = "document";
    public $key = "key colomn";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg([$this->key,"ARRAY","OF","COLUMNS","NAMED THE SAME AS FIELD NAMES"],$id);
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