<?php
namespace controllers\seg;
use controllers\seg as cs;
class Doc_function extends \libs\Controller {

    function __construct() {
        parent::__construct();
        $this->doc_function = new \models\seg\Doc_function();
    }
 function index(){
        
    }
    //view builders
    function input($id = "rand", $script = true,$opt = NULL){
        $this->doc_function->input($id,$script,$opt);
    }
    function edit(){
        
    }
}