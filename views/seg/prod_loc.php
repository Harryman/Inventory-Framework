<?php
namespace views\seg;
class Prod_loc extends \libs\View {

    protected $table = "prod_loc";
    function __construct(){
        parent::__construct();
    }
 

    function add($fkey){
        echo"<div id=\"prod_loc\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-corner-all\">Location Num:<input type=\"text\" class=\"prodac ui-corner-all ui-widget-content\" id=\"id\" name=\"id\" placeholder=\"type or scan prod_loc tag must be exact\"/><div id=\"save\"></div></h3>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo "prod_loc.save(\"#".$fkey." > #prod_loc > h3 > #save\",".$fkey.")";
        $this->scriptEnd();
    }

    function view($fkey){
        echo"<div id=\"prod_loc\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Locations<div class='buttons'><div id=\"edit\"></div></div></h3>
                <div class='clearfloat'></div>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo"prod_loc.edit(\"#".$fkey." > #prod_loc > h3 > div #edit\",'".$fkey."');";
        echo"prod_loc.data(\"".$fkey."\");";
        $this->scriptEnd();
    }
}
  