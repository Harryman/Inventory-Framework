<?php
namespace libs;
class View {

	function __construct() {
	}

	public function render($name, $noInclude = false){
            if ($noInclude == true) {
                require 'views/' . $name . '.php';	
            }
            else {
                require 'views/header.php';
                require 'views/' . $name . '.php';
                require 'views/footer.php';	
            }
	}
        
        function start(){
        echo "<div id=\"".$this->id ."\" >
                <div id=\"".$this->table."\" class=\"text ui-widget-content ui-corner-all\">";
        }
        
        function end(){
            echo"</div></div>";
        }
  
        function dataStart($title = null){
          echo"<div id=\"data\">
          <h2 class=\"ui-widget-header ui-corner-all\">".$title."<div class=\"buttons\">
            </div></h2><div id=\"validate-msg\"></div>
            <div class=\"clearfloat\"></div>
                <form class=\"mar-laft\">";
        }
        function dataEnd(){
            echo"</form></div>";
        }
        function scriptStart(){
            echo "<script>$(function(){
                ";
        }
        function scriptEnd(){
            echo"});</script>
                ";
        }
        function btnAdd($callback, $title, $fkey = null){
            echo $handle.".add(\"".$callback."\",\"".$title."\",\"".$fkey."\");
                ";
        }
        function btnEdit($handle = $this->handle){
            echo $handle.".edit();
                ";
        }
        function btnCancel($handle = $this->handle){
            echo $handle.".cancel();
                ";
        }
        function btnSave($handle = $this->handle){
            echo $handle.".save();
                ";
        }
        function btnDel($handle = $this->handle){
            echo $handle.".del();
                ";
        }
            
        function newBtns($container,$inst = "1"){
            $handle = $this->table.$this->id.$inst;
            echo $handle." = new Btnset(\"".$this->id."\",\"".$this->table."\",\"".$container."\");
                ";
            if($inst){
                $this->handle = $handle;
            }
            return $handle;
            
        }
        function inputField($type, $name, $label, $placeholder = false, $option= false ){
            echo "<div id=\"".$name."\" class=\"mar-left\">";
            if($type == "text"){
                echo $label." <input id=\"".$name."\" type=\"text\" name=\"".$name."\"";
                if($placeholder != false){
                    echo"placeholder=\"".$placeholder."\"";
                }
                if($option != false){
                    echo $option;
                }
                echo "class=\"text ui-widget-content ui-corner-all\">";   
            }
            if($type =="textarea"){
                echo $label."<br/><textarea name=\"".$name."\" id=\"".$name."\" cols=\"75\" class=\"text ui-widget-content ui-corner-all\" ";
                if($placeholder != false){
                    echo "placeholder=\"".$placeholder."\" ";
                }
                if($option != false){
                    echo "rows=\"".$option."\" ";
                }
                echo "></textarea>";
            }
            echo"<div class=\"buttons\"></div><div class=\"clearfloat\"></div></div>";
        }
}
