<?php
namespace views\seg;
class Prod_cat extends \libs\View {

    protected $table = "prod_cat";
    function __construct(){
        parent::__construct();
    }
 

    function add($fkey){
        $this->loadJs();
        echo"<div id='1'>"; //for testing only REMOVE BEFORE USE
        echo"<div id=\"prod_cat\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-corner-all\">Category<div style=\"width:15%\" id=\"menu\"></div></h3>
            </div>
            ";
        $this->scriptStart();
        echo "menuInput(\"#".$fkey." > #prod_cat #menu\",\"seg/category/getfkey/\",0,\"category\");
            prod_cat.menu(\"#".$fkey." > #prod_cat #menu\",\"#".$fkey." > #prod_cat #category\",\"".$fkey."\");
                prod_cat.data(\"".$fkey."\",true);
                ";
        $this->scriptEnd();
        echo"</div>"; //TESTING ONLY REMOVE BEFORE USE;
    }

    function view($fkey){
        $this->loadJs();
                echo"<div id='1'>"; //for testing only REMOVE BEFORE USE
        echo"<div id=\"prod_cat\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Categories<div class='buttons'></div></h3>
                <div class='clearfloat'></div>
            </div>
            ";
        $this->scriptStart();
        $this->newBtns(" > h3 ",$fkey);
        $this->btnEditSeg();
        echo"prod_cat.data(\"".$fkey."\");";
        $this->scriptEnd();
        echo"</div>"; //TESTING ONLY REMOVE BEFORE USE;
    }
}
  