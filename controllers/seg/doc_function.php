<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class doc_function extends \libs\Controller {

    protected $table = "doc_function";
    
    function __construct() {
        parent::__construct();
        $this->doc_functionM = new \models\seg\Doc_function();
        $this->doc_func_argument = new cs\Doc_func_argument();
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
        $this->doc_functionV->edit($id);
    }
    function view($id){
        $this->doc_functionV = new vs\doc_function($id);
        $this->doc_functionV->start("margin");
        $this->doc_functionV->data();
        $ids = $this->doc_functionM->getFkey($id);
        if(isset($ids)){
            foreach($ids as $ent){
                $this->doc_func_argument->view($ent);
            }
        }
        $this->doc_functionV->end();
    }
    function data($id){
        $this->doc_functionV = new vs\doc_function($id);
        $this->doc_functionV->data();
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