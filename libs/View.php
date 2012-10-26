<?php
namespace libs;
class View {

	function __construct() {
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';	
		}
	}
        
        function start($title){
        if($this->id == "rand"){
            $noid = true;
            $this->id = mt_rand();
        }
        else{
            $this->noid = false;
        }
        echo "<div id=\"".$this->id ."\" >
                <div id=\"".$this->table."\" class=\"text ui-widget-content ui-corner-all\"> 
                <h2 class=\"ui-widget-header ui-corner-all\">".$title."<div class=\"buttons\">";
        echo"</div></h2><div id=\"validate-msg\"></div>
            <div class=\"clearfloat\"></div>";
        }
        
        function dataStart(){
            echo"<div id=\"data\" class=\"mar-laft\">
                <form>";
        }
        function dataEnd(){
            echo"</form></div>"
        }
        function scriptStart(){
            echo "<script>$(function){";
        }
        function scriptEnd(){
            echo"});</script>";
        }
        function btnAdd($handle,$callback, $title, $fkey = null){
            echo $handle.".add(\"".$callback."\",\"".$title."\",\"".$fkey."\");";
        }
        function btnEdit($handle){
            echo $handle.".edit();";
        }
        function btnCancel($handle){
            echo $handle.".cancel();";
        }
        function btnSave($handle){
            echo $handle."save();";
        }
        function btnDel($handle){
            echo $handle".del();";
        }
            
        }
        function newBtns($inst, $container){
            $handle = $this->id+$this->table+$inst;
            echo $handle." = new btset(\"".$this->id."\",\"".$this->table."\",\"".$container."\")";
            return $handle;
            
        }
        function inputField($name, $type, $label, $button = false, $placeholder = false, $option= false ){
            if($type == "text"){
                echo "<div id=\"".$name."\"> ".$label." <input id=\"".$name."\" type=\"text\" name=\"".$name."\"";
                if($placeholder != false){
                    echo"placeholder=\"".$placeholder."\"";
                }
                if($option != false){
                    echo $option;
                }
                echo "class=\"text ui-widget-content ui-corner-all\"><br/>";   
            }
            if($buttons != false){
                echo"<div class=\"buttons\">";
                foreach($button as $but){
                    echo "<div id=\"".$but."\" title=\"".$but."\"></div>
                        ";
                }
                echo "</div>
                    <div class=\"clearfloat\">
                    <script>
                        $(function(){
                            bt
                }
        }*/

}