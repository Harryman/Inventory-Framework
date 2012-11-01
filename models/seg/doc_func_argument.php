<?php
namespace models\seg;
class Doc_func_argument extends \libs\Model {
    public $table = "doc_func_argument";
    public $key = "arg_id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg(["arg_id","func_id","arg","arg_desc"],$id);
       echo $ret; 
    }
    function get($id){
        $ret = $this->getSeg($this->key, $id);
        echo $ret;
    }
    function getFkey($fkey){
        $ret = $this->getColWhere("arg_id", "doc_func_argument", "func_id", $fkey);
        return $ret;
    }
    function del($id){
        $this->delSeg($this->key, $id);
    }
}