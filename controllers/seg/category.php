<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Category extends \libs\Controller {

    protected $table = "category";
    
    function __construct(){
        parent::__construct();
        $this->categoryM = new \models\seg\category();
    }
    function index(){
        $this->categoryM = new \models\seg\category();
        $this->categoryM->getParents(4);
    }
 
    function add(){
        $this->categoryV = new vs\category();  
        $this->categoryV->add();
    }
    function edit($id = null){
        $this->categoryV = new vs\category($id);
        $this->categoryV->edit($id);
    }
    function view(){
        $this->categoryV = new vs\category();
        $this->categoryV->view();
    }
    function data(){
        $this->categoryV = new vs\category();
        $this->categoryV->data();
    }
    function getParents($id){
        $this->categoryM = new \models\seg\category();
        $this->categoryM->getParents($id);
    }
    function getcats(){
        $this->categoryM->getCats();
    }
    function getfkey($fkey){
          //$this->categoryM = new \models\seg\category(); 
          $this->categoryM->getfkey($fkey);
          }
    function delete($id){
        $this->categoryM->del($id);
    }
    function save($id = null){
        $this->categoryM->insert($id);      
    }
    public function get($id){
        $this->categoryM->get($id);
    }
    function insert($id){
        $this->categoryM->insert($id);     
    }    
}