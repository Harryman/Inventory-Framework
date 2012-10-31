<?php
namespace libs;

class Controller {

    function __construct() {
        
    }
}
 spl_autoload_register(function($className){
        $fileLocation = str_replace('\\',PATH_SEP, $className).".php";
       // echo $fileLocation;
        require_once($fileLocation);
        
    });