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
  //  function input($id = "rand"){
 //       $this->documentV->input($id);
 //   }
    
    function add(){
        $this->documentV = new \views\seg\Document(mt_rand(100000000,mt_getrandmax()));  
        $this->documentV->add();
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
   // function view($id,$rapt = "no"){
 //       $this->documentV->view($id,$rapt);
    //    }

    
    // ajax handlers
    function insert($id){
        $this->documentM->insert($id);     
    }    
}