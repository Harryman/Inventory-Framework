<?php
namespace libs;
class View {

	function __construct() {
	}      
        function start($class = null,$seg = true){
             $this->loadJs($seg);
        echo "<div id=\"".$this->id ."\" >
                <div id=\"".$this->table."\" class=\"".$class." text ui-widget-content ui-corner-all\">
                   ";
        }
        
        function end(){
            echo"</div></div>";
        }
        function loadJs($seg = TRUE){
            if($seg){
                if(file_exists("js/seg/".$this->table.".js")){
                    echo"<script src=\"".URL."js/seg/".$this->table.".js\"></script>";
                }
            }
            else{
                if(file_exists(URL."js/".$this->table.".js")){
                    echo"<script src=\"".URL."js/".$this->table.".js\"/></script>";
                }
            }
        }
  
        function dataStart($title = null){
          echo"<div id=\"data\">
          <h2 class=\"ui-widget-header ui-corner-all\">".$title."<div class=\"buttons\"></div></h2>
            <div class=\"clearfloat\"></div>
                  ";
        }
        function dataEnd(){
            echo"</div>";
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
        function btnEdit($noProp = null, $handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".edit(".$noProp.");
                ";
        }
        function btnCancel($noProp = NULL, $handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".cancel(".$noProp.");
                ";
        }
        function btnSave($noProp = NULL, $handle = NULL){ 
            if($handle == NULL){
                $handle = $this->handle;
            }
            echo $handle.".save(".$noProp.");
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
            echo "<div id=\"".$name."\" class=\"mar-left\">";
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
            echo"<div class=\"buttons\"></div><div class=\"clearfloat\"></div></div>";
        }
}
