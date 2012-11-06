<?php
namespace views\seg;
class Category extends \libs\View{

    protected $table = "category";
    protected $id;
    function __construct($idr = Null){
        parent::__construct();
        if($idr == Null){
            $idr = mt_rand(100000000,mt_getrandmax());
        }
        $this->id = $idr;
    }
    function start($class = null,$seg = true){
        $this->loadJs();
         echo"<div id=\"".$this->id."\">
                <div id=\"".$this->table."\"><h3>Categories</h3>";
    }
    function dataStart($title = NULL){
            echo"<div class=\"indent ui-corner-all\" id=\"data\">
                <h3 class=\"ui-widget-header\">".$title."<div class=\"buttons\"></div></h3>
                    <div class=\"clearfloat\"></div>
                        ";
    }
    function edit($parent_id = 0, $level = 0){
        $this->dataStart();
        $this->inputField("text","name","Name:","Category Name");
        $this->inputField("textarea","description","Description:","This will be visible on the store, keep it short",2);
        $this->inputField("hidden", "id", $parent_id);
        $this->inputField("hidden", "level", $level);
        echo "<div id=\"test\" style=\"width:15%\">Parent:<input name=\"parent_id\" id=\"parent_id\" type=\"text\" value=\"\"/></div>";
        $this->scriptStart();
        echo "menuInput(\"#test\",\"seg/category/getfkey/\",0,\"menu\");";
        echo "$(\"#category\").ajaxStop(function(){	
            $( \"#menu\" ).menu({
			select: function( event, ui ) {
				var link = ui.item.attr(\"id\");
                                $(\"#test > input\").val(link);
			}
                        });
		});            
        ";
        $this->newBtns(" #name");
        if($this->id < 99999999){
            $this->btnCancel();
        }
        $this->btnSave(TRUE);
        echo $this->handle.".formFill(\"name\");";
        $this->scriptEnd();
        $this->dataEnd();      
    }
    function add(){       
    }
    function view(){
        $this->start();
        $this->edit();
        echo"<div class=\"ui-widget-content ui-corner-all\">
            <h2>Click to Edit Category </h2>
            <div style=\"width:15%\" id=\"edit\"></div></div>";
        $this->scriptStart();
            echo"menuInput(\"#edit\",\"seg/category/getfkey/\",0,\"editmenu\");
                $(\"#edit\").ajaxStop(function(){
            
                        $( \"#editmenu\" ).menu({
			select: function( event, ui ) {
				var link = ui.item.attr(\"id\");
                                $.getJSON(urlbase+\"seg/category/get/\"+link,function(data){
                                    $(\"input#id\").val(data.id);
                                    $(\"input#name\").val(data.name);
                                    $(\"input#parent_id\").val(data.parent_id);
                                    $(\"textarea#description\").val(data.description);
                                });
                        }
		});
                });";
        $this->scriptEnd();
        $this->end();
    }
    function data(){
        $this->dataStart();
        echo" 
            <div class=\"margin\" id=\"description\">Description:<br/></div>
            <div id=\"level\" style=\"display:none\"></div> 
            ";
        $this->newBtns(" > h3");
        $this->btnEdit();
        $this->scriptEnd();
        $this->dataEnd();
    }
    
}
  