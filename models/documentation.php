<?php 
namespace models;
class Documentation extends \libs\Model {

    function __construct() {
        parent::__construct();
    }
    function index(){
        
    }
    function term($term){
        $that = $this->getColWhere("doc_id", "document", "namespace", $term);
        return $that['doc_id'];
    }
    function ac($namespace){
        header('Content-Type: application/json');
        echo $this->getAC("document","namespace","namespace", $namespace);   
    }
}