<?php
namespace controllers\seg;
use \views\seg as vs;
class Doc_function extends \libs\Controller {

    protected $table = "doc_function";
    
    function __construct() {
        parent::__construct();
        $this->doc_functionM = new \models\seg\Doc_function();
        
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->doc_functionV = new vs\doc_function();  
        $this->doc_functionV->add($fkey);
    }
    function edit($id = null){
        $this->doc_functionV = new vs\doc_function($id);
        $this->doc_functionV->edit();
    }
    function view($id,$fkey = null){
       $this->doc_functionV = new vs\doc_function($id);
       $this->doc_functionV->view();
    }
    function data($id,$fkey = NULL){
        $this->doc_functionV = new vs\doc_function($id);
        if(!$fkey){
            $this->doc_functionV->data();
        }
        else{
            $ids = $this->doc_functionM->getFkey($fkey);
            foreach($ids as $ent){
                $this->view($ent);
            }
        }
    }
    function delete($id){
        $this->doc_functionM->del($id);
    }
    function save($id = null){
        $this->doc_functionM->insert($id);      
    }
    public function get($id){
        $this->doc_functionM->get($id);
    }
    function insert($id){
        $this->doc_functionM->insert($id);     
    }    
}