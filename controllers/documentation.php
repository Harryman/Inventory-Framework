<?php
namespace controllers;
use controllers\seg as cs;
class Documentation extends \libs\Controller {
//Controller addpart not seg
    
    function __construct() {
        parent::__construct();
        $this->model = new \models\Documentation();
        $this->view = new \views\Documentation();
        $this->document = new cs\Document();

    }
    
    function index(){
        $this->view->index();    
    }
    function view($id, $term = false){
        require 'views/header.php';
        if($term != "true"){
            $id = $this->model->term($id);
        }
        $this->view->search();
        $this->document->view($id);
        require 'views/footer.php';
    }
    function ac(){
        $namespace = $_GET['term'];
        $this->model->ac($namespace);
    }
    function add(){
        $this->document = new cs\Document();
       // $this->view->search();
        require 'views/header.php';
                $this->view->search();
        $this->document->input();
        require 'views/footer.php';
    }
    function search(){
          require 'views/header.php';
                $this->view->search();
    //    $this->document->input();
        require 'views/footer.php';
    }

    function other($arg1){
        echo"other method";
    }
}
        