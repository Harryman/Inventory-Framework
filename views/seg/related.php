<?php
namespace views\seg;
class Related extends \libs\View {

    protected $table = "related";
    function __construct(){
        parent::__construct();
    }
 

    function add($fkey){
        echo"<div id=\"related\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-corner-all\">Related Part:<input type=\"text\" class=\"prodac ui-corner-all ui-widget-content\" id=\"related_id\" name=\"related_id\" placeholder=\"Start typing or scan location tag\"/><div id=\"save\"></div></h3>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo "prodAC();";
        echo "related.save(\"#".$fkey." > #related > h3 > #save\",".$fkey.")";
        $this->scriptEnd();
    }

    function view($fkey){
        echo"<div id=\"related\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Related Parts<div class='buttons'><div id=\"edit\"></div></div></h3>
                <div class='clearfloat'></div>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo"related.edit(\"#".$fkey." > #related > h3 > div #edit\",'".$fkey."');";
        echo"related.data(\"".$fkey."\");";
        $this->scriptEnd();
    }
}
  