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
            echo"<div id=\"data\">
                <h2>".$title."<div class=\"buttons\"></div></h2>
                    <div class=\"clearfloat\"></div>
                        ";
    }
    function edit($parent_id = 0, $level = 0){
        if($parent_id == 0){
            $this->dataStart();
        }
        else{
        $this->dataStart();
        }
        $this->inputField("text","name","Name:","Category Name");
        $this->inputField("textarea","description","Description:","This will be visible on the store, keep it short",2);
        $this->inputField("hidden", "parent_id", $parent_id);
        $this->inputField("hidden", "level", $level);
        $this->scriptStart();
        $this->newBtns(" #name");
        if($this->id < 99999999){
            $this->btnCancel();
        }
        $this->btnAdd("category","Add a Subcategory",$parent_id);
        $this->btnSave(TRUE);
        echo $this->handle.".formFill(\"name\");";
        $this->scriptEnd();
        $this->dataEnd();      
    }
    function add(){
        $this->edit();
    }
    function view(){
        $this->start("margin");
        $this->edit();
        echo"<div id=\"root\"></div>";
        $this->end();
    }
    function data(){
        $this->dataStart();
        echo"<div class=\"indent\">
            <h3><div class=\"buttons\"></div></h3>
            <div id=\"description\">Description<br</div>
            </div>";
        $this->scriptStart();
        $this->newBtns(" > h3");
        $this->btnEdit();
        $this->scriptEnd();
        $this->dataEnd();
    }
    
}
  