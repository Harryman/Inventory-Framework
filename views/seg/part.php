<?php
namespace views\seg;
class Part extends \libs\View {

    protected $table = "part";
    function __construct(){
        parent::__construct();
    }
 

    function head(){
        echo"<div id=\"part\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Parts of this Assembly
                    <div class=\"buttons\"></div>
                    <div class=\"clearfloat\"></div>
                </h3>
                <div id=\"data\"></div>
            </div>
            ";
        $this->loadJs();
    }
    function add($fkey){
        $this->scriptStart();
        echo $this->table.".add(".$fkey.");
            ";
        $this->scriptEnd();
    }
    function edit($id){
        $this->scriptStart();

        $this->scriptEnd();
    }
    function data($fkey){
        $this->scriptStart();
        echo $this->table.".data(".$fkey.")";
        $this->scriptEnd();
    }
}
  