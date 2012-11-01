<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class XYZ extends \libs\Controller {

    protected $table = "XYZ";
    
    function __construct() {
        parent::__construct();
        $this->XYZM = new \models\seg\XYZ();
        $this->CHILD = new cs\CHILD();
    }
    function index(){
        $this->add();
    }
    function add(){
        $this->XYZV = new vs\XYZ();  
        $this->XYZV->add();
    }
    function edit($id = null){
        $this->XYZV = new vs\XYZ($id);
        $this->XYZV->edit($id);
    }
    function view($id){
        $this->XYZV = new vs\XYZ($id);
        $this->XYZV->start();
        $this->XYZV->data();
        $ids = $this->XYZM->getFkey($id);
        if(isset($ids)){
            foreach($ids as $ent){
                $this->CHILD->view($ent);
            }
        }
        $this->XYZV->end();
    }
    function data($id){
        $this->XYZV = new vs\XYZ($id);
        $this->XYZV->data();
    }
    function delete($id){
        $this->XYZM->del($id);
    }
    function save($id = null){
        $this->XYZM->insert($id);      
    }
    public function get($id){
        $this->XYZM->get($id);
    }
    function insert($id){
        $this->XYZM->insert($id);     
    }    
}