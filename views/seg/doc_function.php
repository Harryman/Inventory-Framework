<?php
namespace views\seg;
class Doc_function extends \libs\View {

    function __construct() {
        parent::__construct();
    }
    
    function input($id){
        $this->inputStart($id,"doc_function");               
    }
    function code($button){
        $this->inputField("code", "textarea", "Code: ", $button, "Put the code of the function in here");
    }
}