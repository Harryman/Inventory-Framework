<?php
namespace controllers\seg;
use \views\seg as vs;
class Doc_func_argument extends \libs\Controller {

    protected $table = "doc_func_argument";
    
    function __construct() {
        parent::__construct();
        $this->doc_func_argumentM = new \models\seg\doc_func_argument();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->doc_func_argumentV = new vs\doc_func_argument();  
        $this->doc_func_argumentV->add($fkey);
    }
    function edit($id = null){
        $this->doc_func_argumentV = new vs\doc_func_argument($id);
        $this->doc_func_argumentV->edit($id);
    }
    function view($id){
        $this->doc_func_argumentV = new vs\doc_func_argument($id);
        $this->doc_func_argumentV->view();
    }
    function data($id){
        $this->doc_func_argumentV = new vs\doc_func_argument($id);
        $this->doc_func_argumentV->data();
    }
    function delete($id){
        $this->doc_func_argumentM->del($id);
    }
    function save($id = null){
        $this->doc_func_argumentM->insert($id);      
    }
    public function get($id){
        $this->doc_func_argumentM->get($id);
    }
    function insert($id){
        $this->doc_func_argumentM->insert($id);     
    }    
}