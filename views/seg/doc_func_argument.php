<?php
namespace views\seg;
class Doc_func_argument extends \libs\View {

    protected $table = "doc_func_argument";
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
        $this->dataStart("Argument");
        $this->inputField("text","arg","Argument: ","argument name");
        $this->inputField("textarea","arg_desc","Description:","Describe what this argument does",4);
        $this->inputField("hidden", "func_id", $fkey);
        $this->scriptStart();
        $this->newBtns(" > h2 ");
        $this->btnDel();
        if($this->id < 99999999){
            $this->btnCancel();
        }
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
        echo"<div class=\"mar-left\"><div>Description:<div class=\"textformat\" id=\"arg_desc\"></div></div><br/></div>";
        $this->scriptStart();
        $this->newBtns(" > h2");
        $this->btnEdit();
        echo $this->handle.".dataFill(\"arg\")";
        $this->scriptEnd();
        $this->dataEnd();
    }
}
  