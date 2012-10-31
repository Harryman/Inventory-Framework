<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Document extends \libs\Controller {

    protected $table = "document";
    
    function __construct() {
        parent::__construct();
        $this->documentM = new \models\seg\Document();
        //require_once "/controllers/seg/doc_function.php";
        $this->doc_function = new cs\Doc_function();
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
        $this->documentV->start();
        $this->documentV->data();
        $ids = $this->documentM->getFkey($id);
        if(isset($ids)){
            foreach($ids as $ent){
                $this->doc_function->view($ent);
            }
        }
        $this->documentV->end();
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