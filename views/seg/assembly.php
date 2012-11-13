<?php
namespace views\seg;
class Assembly extends \libs\View {

    protected $table = "assembly";
    function __construct(){
        parent::__construct();
    }
 

    function head(){
        echo"<div id=\"assembly\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Assembly Instructions
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
  