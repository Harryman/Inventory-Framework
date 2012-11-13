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
        $this->partV->head();
        $this->partV->add($id);
    }
    function view($id){
        $this->partV->head();
        $this->partV->add($id);
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
        $this->partM->getNextId($this->table);
    }
    public function getData($id){
        $this->partM->getData($id);
    }
    public function getAllData($p_id){
        $this->partM->getAllData($p_id);
    }
    function insert(){
        $id = $_POST['id'];
        $this->partM->insert($id);     
    }    
}