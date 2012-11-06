<?php
namespace views\seg;
class Compatible extends \libs\View {

    protected $table = "compatible";
    function __construct(){
        parent::__construct();
    }
 

    function add($fkey){
        echo"<div id=\"compatible\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-corner-all\">Compatible Part:<input type=\"text\" class=\"prodac ui-corner-all ui-widget-content\" id=\"compatible_id\" name=\"compatible_id\" placeholder=\"Start typing or scan location tag\"/><div id=\"save\"></div></h3>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo "prodAC();";
        echo "compatible.save(\"#".$fkey." > #compatible > h3 > #save\",".$fkey.")";
        $this->scriptEnd();
    }

    function view($fkey){
        echo"<div id=\"compatible\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Compatible Parts<div class='buttons'><div id=\"edit\"></div></div></h3>
                <div class='clearfloat'></div>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo"compatible.edit(\"#".$fkey." > #compatible > h3 > div #edit\",'".$fkey."');";
        echo"compatible.data(\"".$fkey."\");";
        $this->scriptEnd();
    }
}
  