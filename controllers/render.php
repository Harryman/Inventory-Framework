<?php
namespace controllers;
use \views\seg as vs;
use \controllers\seg as cs;
class Render extends \libs\Controller {

    protected $table = "XYZ";
    
    function __construct() {
        parent::__construct();
    }
    function renderSeg($toRend,$opt1 = null,$opt2 = null){
        $toRend = "\controllers\seg\\".$toRend;
        require_once'views/header.php';
        echo"<div id=1>";
        $toRend::$opt1($opt2);
        echo"</div>";
        require_once'views/footer.php';
    }
}