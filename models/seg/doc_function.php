<?php
namespace models\seg;
class Doc_function extends \libs\Model {
    public $table = "doc_function";
    public $key = "func_id";
    function __construct() {
        parent::__construct();
    }
     function insert($id){
       $ret = $this->insertSeg(["func_id", "doc_id","func_name", "code", "description"],$id);
       echo $ret;
    }
    function get($id){
        $ret = $this->getSeg($this->key, $id);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function getFkey($fkey){
        $ret = $this->getColWhere("arg_id", "doc_func_argument", "func_id", $fkey);
        return $ret;
    }
    function del($id){
        $this->delSeg("func_id", $id);
    }
}