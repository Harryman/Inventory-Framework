<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Product extends \libs\Controller {

    protected $table = "product";
    
    function __construct() {
        parent::__construct();
        $this->ProductM = new \models\seg\Product();
       // $this->CHILD = new cs\CHILD();
    }
    function index(){
        $this->add();
    }
    function add(){
        $this->ProductV = new vs\Product();  
        $this->ProductV->add();
    }
    function edit($id = null){
        $this->ProductV = new vs\Product($id);
        $this->ProductV->edit($id);
    }
    function view($id){
        $this->ProductV = new vs\Product($id);
        $this->ProductV->start();
        $this->ProductV->data();
        $ids = $this->ProductM->getFkey($id);
        if(isset($ids)){
            foreach($ids as $ent){
               // $this->CHILD->view($ent);
            }
        }
        $this->ProductV->end();
    }
    function data($id){
        $this->ProductV = new vs\Product($id);
        $this->ProductV->data();
    }
    function delete($id){
        $this->ProductM->del($id);
    }
    function save($id = null){
        $this->ProductM->insert($id);      
    }
    public function get($id){
        $this->ProductM->get($id);
    }
    function insert($id){
        $this->ProductM->insert($id);     
    }
    function getNextId(){
        $this->productM->getNextId($this->table);
    }
    function ac(){
        $field = $_GET['term'];
        $this->ProductM->ac($field);
    }
}