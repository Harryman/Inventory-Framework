<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Related extends \libs\Controller {

    protected $table = "related";
    
    function __construct() {
        parent::__construct();
        $this->relatedM = new \models\seg\Related();
        $this->relatedV = new vs\Related();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->relatedV->add($fkey);
    }
    function edit($fkey){
        $this->add($fkey);
    }
    function view($id){
        $this->relatedV->view($id);
    }
    function data($id){
        $this->relatedV->data($id);
    }
    function delete(){
        $this->relatedM->del();
    }
    public function get($id){
        $this->relatedM->get($id);
    }
    function insert(){
        $this->relatedM->insert();     
    }    
}