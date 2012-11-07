<?php
namespace controllers\seg;
use \views\seg as vs;
use \controllers\seg as cs;
class Pic extends \libs\Controller {

    protected $table = "pic";
    
    function __construct() {
        parent::__construct();
        $this->picM = new \models\seg\Pic();
        $this->picV = new vs\Pic();
    }
    function index(){
        $this->add();
    }
    function add($fkey){
        $this->picM = new \models\seg\Pic();
        $this->picV = new vs\Pic();
        $this->picV->add($fkey);
    }
    function view($id){
        $this->picM = new \models\seg\Pic();
        $this->picV = new vs\Pic();
        $this->picV->view($id);
    }
    function data($id){
        $this->picV->data($id);
    }
    function delete(){
        $this->picM->del();
    }
    public function get($id){
        $this->picM->get($id);
    }
    function upload(){
        $this->picM = new \models\seg\Pic();
        $this->picM->upload();
    }
    function update($id,$p_id){
        $this->picM = new \models\seg\Pic();
        $this->picM->update($p_id,$id);
        
    }
    function insert(){
        $this->picM->insert();     
    }    
}