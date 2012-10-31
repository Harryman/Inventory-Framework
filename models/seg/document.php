<?php
namespace models\seg;
class Document extends \libs\Model {
    public $table = "document";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg(["doc_id", "namespace", "description", "code"],$id);
       echo $ret; 
    }
    function get($id){
        $ret = $this->getSeg("doc_id", $id);
        echo $ret;
    }
    function del($id){
        $this->delSeg("doc_id", $id);
    }
    function getFkey($fkey){
        $ret = $this->getColWhere("func_id", "doc_function", "doc_id", $fkey);
        return $ret;
    }
}