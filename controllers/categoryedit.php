<?php
namespace controllers;
use controllers\seg as cs;
class Categoryedit extends \libs\Controller {
//Controller addpart not seg
    
    function __construct() {
        parent::__construct();
        $this->category = new cs\Category();

    }
    
    function index(){
        $this->view->index();    
    }
    function view(){
        require 'views/header.php';
        $this->category->view();
        require 'views/footer.php';
    }
    function ac(){
        $namespace = $_GET['term'];
        $this->model->ac($namespace);
    }
    function add(){
        //$this->category = new cs\category();
        require 'views/header.php';
        $this->view->search();
        $this->category->add();
        require 'views/footer.php';
    }
    function search(){
        require 'views/header.php';
        $this->view->search();
        require 'views/footer.php';
    }
}
        