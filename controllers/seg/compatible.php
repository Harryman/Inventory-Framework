<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Compatible extends \libs\Controller {

    protected $table = "compatible";
    
    function __construct() {
        parent::__construct();
        $this->compatibleM = new \models\seg\Compatible();
        $this->compatibleV = new vs\Compatible();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->compatibleV->add($fkey);
    }
    function edit($fkey){
        $this->add($fkey);
    }
    function view($id){
        $this->compatibleV->view($id);
    }
    function data($id){
        $this->compatibleV->data($id);
    }
    function delete(){
        $this->compatibleM->del();
    }
    public function get($id){
        $this->compatibleM->get($id);
    }
    function insert(){
        $this->compatibleM->insert();     
    }    
}