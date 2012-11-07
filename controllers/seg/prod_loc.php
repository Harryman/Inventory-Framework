<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Prod_loc extends \libs\Controller {

    protected $table = "Prod_loc";
    
    function __construct() {
        parent::__construct();
        $this->prod_locM = new \models\seg\prod_loc();
        $this->prod_locV = new vs\prod_loc();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->prod_locV->add($fkey);
    }
    function edit($fkey){
        $this->add($fkey);
    }
    function view($id){
        $this->prod_locV->view($id);
    }
    function data($id){
        $this->prod_locV->data($id);
    }
    function delete(){
        $this->prod_locM->del();
    }
    public function get($id){
        $this->prod_locM->get($id);
    }
    function insert(){
        $this->prod_locM->insert();     
    }    
}