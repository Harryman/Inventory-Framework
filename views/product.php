<?php
namespace controllers;
use \controllers\seg as cs;
class Product extends \libs\Controller {

    function __construct() {
        parent::__construct();
        $this->model = new \models\Product();
        $this->view = new \views\Product();
    }
    
    function index(){
        
    }
    
    function add(){
        require 'views/header.php';
        
        require 'views/footer.php';
    }
}