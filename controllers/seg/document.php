<?php
namespace controllers\seg;
class Document extends \libs\Controller {

    protected $table = "document";
    
    function __construct() {
        parent::__construct();
        $this->documentM = new \models\seg\Document();
        
    }
    function index(){
    }
    //view builders 
    function input($id = "rand"){
        $this->documentV->input($id);
    }
    
    function add($id){
        $this->documentV = new \views\seg\Document();
        
    }
    function edit(){
        
    }
    function view(){
        
    }
    function data(){
        
    }
    function delete(){
        
    }
    function none(){
        
    }
    function save(){
        
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