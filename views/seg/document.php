<?php
namespace views\seg;
class Document extends \libs\View {

    protected $table = "document";
    protected $id;
    function __construct($idr = Null){
        parent::__construct();
        if($idr == Null){
            $idr = mt_rand(100000000,mt_getrandmax());
        }
        $this->id = $idr;
    }
 
    function add(){
        $this->start();
        $this->edit("Document");
        $this->end();
    }
    function edit(){
        $this->dataStart("Document");
        $this->inputField("text","namespace","Namespace: ","name/space");
        $this->inputField("textarea","description","Description:","Describe the general purpose of this file",4);
        $this->inputField("textarea","code","Full code:","Paste code here, formatting will be preserved",9);
        $this->scriptStart();
        $this->newBtns(" > h2 ");
        if($this->id < 9999999){
            $this->btnDel();
            $this->btnCancel();
            $this->btnAdd("doc_function","Add a Function",$this->id);
            $this->btnSave(true);
        }
        else{
        $this->btnAdd("doc_function","Add a Function",$this->id);
        $this->btnSave();
        }
        echo $this->handle.".formFill();";
        $this->scriptEnd();
        $this->dataEnd();      
    }
    function view(){
        $this->start();
        $this->data();
        $this->end();
    }
    function data(){
        $this->dataStart();
        echo"<div class=\"mar-left\"><div>Description:<div class=\"textformat\" id=\"description\"></div></div><br/>
            <div>Full Code:<div id=\"toggle_code\"></div><div class=\"code\" id=\"code\" style=\"display: none\">blah</div></div></div>";
        $this->scriptStart();
        $this->newBtns(" > h2");
        $this->btnEdit(true);
        echo $this->handle.".dataFill(\"namespace\");
         $(\"#".$this->id." > #document > #data #toggle_code\").button();
                        $(\"#".$this->id." > #document > #data #toggle_code\").text(\"show\");
                        $(\"#".$this->id." > #document > #data #toggle_code\").click(function(){
                            $(\"#".$this->id." > #document > #data  #code \").toggle(\"blind\",350);
                                if($(\"#".$this->id." > #document > #data #toggle_code\").text() == \"show\"){
                                    $(\"#".$this->id." > #document > #data #toggle_code\").text(\"hide\");
                                }
                                else{
                                $(\"#".$this->id." > #document > #data #toggle_code\").text(\"show\");
                                }
                        });";
        $this->scriptEnd();
        $this->dataEnd();
    }
}
  