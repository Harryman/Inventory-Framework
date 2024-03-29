<?php
namespace views\seg;
class XYZ extends \libs\View {

    protected $table = "XYZ";
    protected $id;
    function __construct($idr = Null){
        parent::__construct();
        if($idr == Null){
            $idr = mt_rand(100000000,mt_getrandmax());
        }
        $this->id = $idr;
    }
 
    function add($fkey){
        $this->start("CLASS TO APPLY TO CONTAINING DIV");
        $this->edit($fkey);
        $this->end();
    }
    function edit($fkey){
        $this->dataStart("FIELD TITLE");
        $this->inputField("text","func_name","Function: ","function name");
        $this->inputField("textarea","description","Description:","Describe the general purpose of this file",4);
        $this->inputField("textarea","code","Function code:","Paste function code here",9);
        $this->inputField("hidden", "FKEY", $fkey);
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
        echo"<div class=\"mar-left\">HTML FOR DISPLAY element with colum ids will have the data appended to it </div>";
        $this->scriptStart();
        $this->newBtns(" > h2");
        $this->btnEdit();
        echo $this->handle.".dataFill(\"COLOMN NAME FOR HEADER\");";
        $this->scriptEnd();
        $this->dataEnd();
    }
}
  