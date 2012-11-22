<?php
namespace controllers;
use \views as vs;
use \controllers as cs;
class SaleCreate extends \libs\Controller {

    protected $table = "saleCreate";
    
    function __construct() {
        parent::__construct();
        $this->saleCreateM = new \models\SaleCreate();
        $this->saleCreateV = new vs\SaleCreate();
    }
    function index(){
        require 'views/header.php';
        $this->saleCreateV->view();
        require 'views/footer.php';
    }

    function add(){
        $sku = $_POST['sku'];
        $this->saleCreateM->add($sku);
    }
   
    function insert(){
        $id = $_POST['id'];
        $this->saleCreateM->insert($id);     
    }    
}