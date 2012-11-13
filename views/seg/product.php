<?php
namespace views\seg;
use controllers\seg as cs;
class XYZ extends \libs\View {

    protected $table = "XYZ";
    protected $id;
    function __construct($idr = Null){
        parent::__construct();
        $this->old_pn = new cs\old_pn();
        if($idr == Null){
            $idr = mt_rand(100000000,mt_getrandmax());
        }
        $this->id = $idr;
    }
 
    function add($fkey){
        $this->start();
        $this->edit();
        $this->end();
    }
    function head()
    function edit($fkey){
        $this->dataStart("Product");
        $this->inputField("text", "id", "Part Number:", "New PN", 10);
        $this->inputField("text", "short_name", "Part Name:", "Be descriptive & unique", 64);
        echo"<div id=\"add_old_pn\">";
        $this->inputField("textarea", "short_desc", "Short description:", "this description will be used as a teaser on the store (max255)", 3);
        $this->inputField("textarea", "desc", "Description:", "Part's external description which will be visible on the store and other places", 4);
        $this->inputField("text", "qty", "Quantity:", "", 6);
        $this->inputField("text", "price", "Price: $", "", 7);
        $this->inputField("text", "cost", "Cost: $", "", 7);
        $this->inputField("textarea", "location", "Location:", "Specify where this is located in a non standard spot or doesn't follow the naming convention", 3);
        $this->inputField("textarea", "ship_note", "Shipping Notes:","Put any notes on shipping in here. i.e. box size, special precautions, blah blah blah",3);
        $this->inputField("textarea", "order_info", "Ordering Information:", "put things like phone numbers, sales reps, urls all that noise or leave it blank if we make it here", 3);
        $this->inputField("textarea", "other_info", "Other", "Put any other information in here that doesn't really have a spot to go", 3);
        $this->inputField("checkbox", "active", "Is this part active:");
        $this->scriptStart();
        $this->newBtns(" > h2 ");
        $this->btnDel();
        $this->btnSave();
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
        echo"<div class=\"mar-left\">HTML FOR DISPLAY element with colum ids will have the data appended to it </div>";
        $this->scriptStart();
        $ts = $this->newBtns(" > h2");
        $this->btnEdit($ts);
        echo $this->handle.".dataFill(\"COLOMN NAME FOR HEADER\");";
        $this->scriptEnd();
        $this->dataEnd();
    }
}
  