<?php
namespace views\seg;
class Doc_function extends \libs\View {

    protected $table = "doc_function";
    protected $id;
    function __construct($idr = Null){
        parent::__construct();
        if($idr == Null){
            $idr = mt_rand(100000000,mt_getrandmax());
        }
        $this->id = $idr;
    }
 
    function add($fkey){
        $this->start("margin");
        $this->edit($fkey);
        $this->end();
    }
    function edit($fkey){
        $this->dataStart("Function");
        $this->inputField("text","func_name","Function: ","function name");
        $this->inputField("textarea","description","Description:","Describe the general purpose of this file",4);
        $this->inputField("textarea","code","Function code:","Paste function code here",9);
        $this->inputField("hidden", "doc_id", $fkey);
        $this->scriptStart();
        $this->newBtns(" > h2 ");
        $this->btnDel();
        if($this->id < 99999999){
            $this->btnCancel();
        }
        $this->btnAdd("doc_func_argument","Add an Argument",$this->id);
        $this->btnSave();
        echo $this->handle.".formFill();";
        $this->scriptEnd();
        $this->dataEnd();      
    }
    function view(){
        $this->start("margin");
        $this->data();
        $this->end();
    }
    function data(){
        $this->dataStart();
        echo"<div class=\"mar-left\"><div>Description:<div class=\"textformat\" id=\"description\"></div></div><br/>
            <div>Full Code:<div id=\"toggle_code\"></div><div class=\"code\" id=\"code\" style=\"display: none\">blah</div></div></div>";
        $this->scriptStart();
        $this->newBtns(" > h2");
        $this->btnEdit();
        echo $this->handle.".dataFill(\"func_name\");
         $(\"#".$this->id." > #".$this->table." > #data #toggle_code\").button();
                        $(\"#".$this->id." > #".$this->table." > #data #toggle_code\").text(\"show\");
                        $(\"#".$this->id." > #".$this->table." > #data #toggle_code\").click(function(){
                            $(\"#".$this->id." > #".$this->table." > #data  #code \").toggle(\"blind\",350);
                                if($(\"#".$this->id." > #".$this->table." > #data #toggle_code\").text() == \"show\"){
                                    $(\"#".$this->id." > #".$this->table." > #data #toggle_code\").text(\"hide\");
                                }
                                else{
                                $(\"#".$this->id." > #".$this->table." > #data #toggle_code\").text(\"show\");
                                }
                        });";
        $this->scriptEnd();
        $this->dataEnd();
    }
}
  