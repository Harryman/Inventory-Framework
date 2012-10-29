<?php
namespace controllers\seg;
use \views\seg as vs;
class Document extends \libs\Controller {

    protected $table = "document";
    
    function __construct() {
        parent::__construct();
        $this->documentM = new \models\seg\Document();
        
    }
    function index(){
        $this->add();
    }
    function add(){
        $this->documentV = new vs\Document();  
        $this->documentV->add();
    }
    function edit($id = null){
        $this->documentV = new vs\Document($id);
        $this->documentV->edit();
    }
    function view($id){
       $this->documentV = new vs\Document($id);
       $this->documentV->view();
    }
    function data($id){
        $this->documentV = new vs\Document($id);
        $this->documentV->data();
    }
    function delete($id){
        $this->documentM->del($id);
    }
    function save($id = null){
        $this->documentM->insert($id);      
    }
    public function get($id){
        $this->documentM->get($id);
    }
    function insert($id){
        $this->documentM->insert($id);     
    }    
}