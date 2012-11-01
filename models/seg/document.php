<?php
namespace models\seg;
class Document extends \libs\Model {
    public $table = "document";
    public $key = "doc_id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg(["doc_id", "namespace", "description", "code"],$id);
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
        $this->delSeg("doc_id", $id);
    }
    function getFkey($fkey){
        $ret = $this->getColWhere("func_id", "doc_function", "doc_id", $fkey);
        return $ret;
    }
}