<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Assembly extends \libs\Controller {

    protected $table = "assembly";
    
    function __construct() {
        parent::__construct();
        $this->assemblyM = new \models\seg\Assembly();
        $this->assemblyV = new vs\Assembly();
    }
    function index(){
        $this->add();
    }

    function edit($fkey){
        $this->add($fkey);
    }
    function add($id){
        $this->assemblyV->head();
        $this->assemblyV->add($id);
    }
    function view($id){
        $this->assemblyV->head();
        $this->assemblyV->add($id);
        $this->assemblyV->data($id);
    }
    function delete(){
        $id = $_POST['id'];
        $this->assemblyM->del($id);
    }
    public function get($id){
        $this->assemblyM->get($id);
    }
    public function getNextId(){
        $this->assemblyM->getNextId($this->table);
    }
    public function getData($id){
        $this->assemblyM->getData($id);
    }
    public function getAllData($p_id){
        $this->assemblyM->getAllData($p_id);
    }
    function insert(){
        $id = $_POST['id'];
        $this->assemblyM->insert($id);     
    }    
}