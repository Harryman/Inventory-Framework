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
        protected function inputStart($id, $table, $fkey = false){
            if ($id == "rand") {
            $noid = true;
            $id = mt_rand();
        }
        else{
            $noid = false;
        }
        echo "<div id=\"".$id ."\" >
                <div id=\"".$table."\" class=\"text ui-widget-content ui-corner-all\"> 
                <h2 class=\"ui-widget-header ui-corner-all\">".$table."</h2>
                <div id=\"form\" class=\"fltlft\">
                <form><p>";
        return $id;
        }
        protected function Start($id,$table,$title,$buttons = false,$fkey = false){
             if ($id == "rand") {
            $noid = true;
            $id = mt_rand();
        }
        else{
            $noid = false;
        }
        echo "<div id=\"".$id ."\" >
                <div id=\"".$table."\" class=\"text ui-widget-content ui-corner-all\"> 
                <h2 class=\"ui-widget-header ui-corner-all\">".$title."<div id=\"buttons\">";
        if($buttons != false){
            foreach($buttons as $but){
                echo"<div id=\"".$but."\"></div>";
            }
        }
        echo"</div></h2>
            <div class=\"clearfloat\"></div>
                <div id=\"data\">
                <form>";
        return $id;
        }
        
        protected function inputField($name, $type, $label, $button = false, $placeholder = false, $option= false ){
            if($type == "text"){
                echo $label." <input id=\"".$name."\" type=\"text\" name=\"".$name."\"";
                if($placeholder != false){
                    echo"placeholder=\"".$placeholder."\"";
                }
                if($option != false){
                    echo $option;
                }
                echo "class=\"text ui-widget-content ui-corner-all\"><br/>";   
            }              
        }

}