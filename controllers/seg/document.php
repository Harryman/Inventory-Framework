<?php
namespace controllers\seg;
class Document extends \libs\Controller {

    function __construct() {
        parent::__construct();
        $this->documentM = new \models\seg\Document();
        $this->documentV = new \views\seg\Document();
    }
    function index(){
    }
    //view builders 
    function input($id = "rand"){
        $this->documentV->input($id);
    }
 
    public function get($id){
        $this->documentM->get($id);
    }
    function view($id,$rapt = "no"){
        $this->documentV->view($id,$rapt);
        }

    
    // ajax handlers
    function insert($id){
        $this->documentM->insert($id);     
    }    
}