<?php
namespace controllers;
use controllers\seg as cs;
class Addpart extends \libs\Controller {
//Controller addpart not seg
    
    function __construct() {
        parent::__construct();
        $this->product = new cs\Product();
        $this->prod_loc = new cs\Prod_loc();
        $this->prod_cat = new cs\Prod_cat();
        $this->compatible = new cs\Compatible();
        $this->related = new cs\Related();
        $this->pic = new cs\Pic();
        $this->external_pn = new cs\External_pn();
        $this->assembly = new cs\Assembly();
        

    }
    
    function index(){
        $this->document = new cs\Document();
        require 'views/header.php';
        $this->document->input();
        require 'views/footer.php';
        
    }

    function other($arg1){
        echo"other method";
    }
}
        
