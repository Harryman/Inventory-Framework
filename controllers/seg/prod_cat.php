<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Prod_cat extends \libs\Controller {

    protected $table = "prod_cat";
    
    function __construct() {
        parent::__construct();
        $this->prod_catM = new \models\seg\prod_cat();
        $this->prod_catV = new vs\prod_cat();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->prod_catV->add($fkey);
    }
    function edit($fkey){
        $this->add($fkey);
    }
    function view($id){
        $this->prod_catV->view($id);
    }
    function data($id){
        $this->prod_catV->data($id);
    }
    function delete(){
        $this->prod_catM->del();
    }
    public function get($id){
        $this->prod_catM->get($id);
    }
    function insert(){
        $this->prod_catM->insert();     
    }    
}