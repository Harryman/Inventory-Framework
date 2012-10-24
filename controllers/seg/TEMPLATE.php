<?php
namespace controllers\seg;
use controllers\seg as cs;
class X extends \libs\Controller {

    function __construct() {
        parent::__construct();
        $this->X = new \models\seg\X();
    }
 function index(){
        
    }
    //view builders
    function input($id = "rand", $script = true,$opt = NULL){
        $this->X->input($id,$script,$opt);
    }
    function edit(){
        
    }
}