<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Part extends \libs\Controller {

    protected $table = "part";
    
    function __construct() {
        parent::__construct();
        $this->partM = new \models\seg\Part();
        $this->partV = new vs\Part();
    }
    function index(){
        $this->add();
    }

    function edit($fkey){
        $this->add($fkey);
    }
    function add($id){
        $this->partV = new vs\Part();
        $this->partV->head();
        $this->partV->add($id);
    }
    function data($id){
        $this->partV->data($id);
    }
    function delete(){
        $id = $_POST['id'];
        $this->partM->del($id);
    }
    public function get($id){
        $this->partM->get($id);
    }
    public function getNextId(){
        $this->partM = new \models\seg\part();
        $this->partM->getNextId($this->table);
    }
    public function getData($id){
        $this->partM = new \models\seg\part();
        $this->partM->getData($this->table);
        
    }
    function insert(){
        $this->partM->insert();     
    }    
}