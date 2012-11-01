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
        
        function start($class = null){
        echo "<div id=\"".$this->id ."\" >
                <div id=\"".$this->table."\" class=\"".$class." text ui-widget-content ui-corner-all\">
                   ";
        }
        
        function end(){
            echo"</div></div>";
        }
  
        function dataStart($title = null){
          echo"<div id=\"data\">
          <h2 class=\"ui-widget-header ui-corner-all\">".$title."<div class=\"buttons\"></div></h2>
            <div class=\"clearfloat\"></div>
                  <div class=\"mar-left\">
                <form>";
        }
        function dataEnd(){
            echo"</form></div></div>";
        }
        function scriptStart(){
            echo "<script>$(function(){
                ";
        }
        function scriptEnd(){
            echo"});</script>
                ";
        }
        function btnAdd($callback, $title, $fkey = null,$handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".add(\"".$callback."\",\"".$title."\",\"".$fkey."\");
                ";
        }
        function btnEdit($handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".edit();
                ";
        }
        function btnCancel($handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".cancel();
                ";
        }
        function btnSave($handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".save();
                ";
        }
        function btnDel($handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".del();
                ";
        }
      //  function getFseg($table, $id){
     //       $this->id = $fkey;
      //      echo"$.get(urlbase+\"seg/".$table."\"/view/1/"
      //  }
            
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
           // echo "<div id=\"".$name."\" class=\"mar-left\">";
            if($type == "text"){
                echo $label." <input id=\"".$name."\" type=\"text\" name=\"".$name."\" class=\"text ui-widget-content ui-corner-all\"";
                if($placeholder != false){
                    echo"placeholder=\"".$placeholder."\"";
                }
                if($option != false){
                    echo "size=\"".$option;
                }
                echo "\"><br/>";   
            }
            if($type =="textarea"){
                echo $label."<br/><textarea name=\"".$name."\" id=\"".$name."\" cols=\"75\" class=\"text ui-widget-content ui-corner-all\" ";
                if($placeholder != false){
                    echo "placeholder=\"".$placeholder."\" ";
                }
                if($option != false){
                    echo "rows=\"".$option."\" ";
                }
                echo "></textarea><br/>";
            }
            if($type =="hidden"){
                echo"<input name=\"".$name."\" id=\"".$name."\" type=\"hidden\" value=\"".$label."\"/>";
            }
            if($type == "checkbox"){
                echo $label."<input type=\"checkbox\" name=\"".$name."\" id=\"$".$name." value=\"1\"/>";
                if($placeholder){
                   echo"<label for=\"".$name."\">".$placeholder."</label>";
                }
                echo"<br/>";
            }
         //   echo"<div class=\"buttons\"></div><div class=\"clearfloat\"></div></div>";
        }
}
