<?php
namespace libs;

class Controller {

    function __construct() {
        
        $this->view = new View();
    }

   
    public function loadModel($name) {

        $path = 'models/' . $name . '_model.php';

        if (file_exists($path)) {
            require 'models/' . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
            echo$modelName;
        }
    }

    public function loadSeg($name) {
        $path = 'models/seg/' . $name . '_model.php';

        if (file_exists($path)) {
            require 'models/seg/' . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->$name = new $modelName();
        }
    }

}
 spl_autoload_register(function($className){
        $fileLocation = str_replace('\\',PATH_SEP, $className).".php";
       // echo $fileLocation;
        require_once($fileLocation);
        
    });