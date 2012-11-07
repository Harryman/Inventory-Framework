<?php
namespace views\seg;
class Pic extends \libs\View {

    protected $table = "pic";
    function __construct(){
        parent::__construct();
    }
 

    function add($fkey){
        echo"<div id=\"pic\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-corner-all\">Upload Images:
                    <form enctype=\"multipart/form-data\" method=\"post\" name=\"pic_upload\" id=\"pic_upload\">
                        <input multiple=\"multiple\" class=\"ui-corner-all ui-widget-content\" type=\"file\" name=\"pic[]\" /> 
                        <input type=\"hidden\" name=\"p_id\" id=\"p_id\" value=\"".$fkey."\"/>
                        <div id=\"upload\">Upload</div>
                    </form>
                </h3>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo "pic.upload(".$fkey.");
            ";
        echo "pic.data(".$fkey.");";
       // echo "pic.update(".$fkey.");";
        $this->scriptEnd();
    }

    function view($fkey){
        echo"<div id=\"pic\" class=\"ui-widget-content ui-corner-all\">
                <h3 class=\"ui-widget-header ui-corner-all\">Locations<div class='buttons'><div id=\"edit\"></div></div></h3>
                <div class='clearfloat'></div>
            </div>
            ";
        $this->loadJs();
        $this->scriptStart();
        echo"pic.edit(\"#".$fkey." > #pic > h3 > div #edit\",'".$fkey."');";
        echo"pic.data(\"".$fkey."\");";
        $this->scriptEnd();
    }
}
  