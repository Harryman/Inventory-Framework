<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class External_pn extends \libs\Controller {

    protected $table = "external_pn";
    
    function __construct() {
        parent::__construct();
        $this->external_pnM = new \models\seg\External_pn();
        $this->external_pnV = new vs\External_pn();
    }
    function index(){
        $this->add();
    }

    function edit($fkey){
        $this->add($fkey);
    }
    function add($id){
        $this->external_pnV->head();
        $this->external_pnV->add($id);
    }
    function view($id){
        $this->external_pnV->head();
        $this->external_pnV->add($id);
        $this->external_pnV->data($id);
    }
    function delete(){
        $id = $_POST['id'];
        $this->external_pnM->del($id);
    }
    public function get($id){
        $this->external_pnM->get($id);
    }
    public function getNextId(){
        $this->external_pnM->getNextId($this->table);
    }
    public function getData($id){
        $this->external_pnM->getData($id);
    }
    public function getAllData($p_id){
        $this->external_pnM->getAllData($p_id);
    }
    function insert(){
        $id = $_POST['id'];
        $this->external_pnM->insert($id);     
    }    
}