<?php
namespace models\seg;
class Doc_function extends \libs\Model {
    public $table = "doc_function";
    function __construct() {
        parent::__construct();
    }
     function insert($id){
       $ret = $this->insertSeg(["func_id", "doc_id", "code", "description"],$id);
       echo $ret; 
    }
    function get($id){
        $ret = $this->getSeg("func_id", $id);
        echo $ret;
    }
    function del($id){
        $this->delSeg("func_id", $id);
    }
}