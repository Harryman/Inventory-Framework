<?php
namespace controllers;
use controllers\seg as cs;
class Addpart extends \libs\Controller {
//Controller addpart not seg
    
    function __construct() {
        parent::__construct();

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
        
