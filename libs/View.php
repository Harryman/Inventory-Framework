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
        protected function inputStart($id, $table){
            if ($id == "rand") {
            $noid = true;
            $id = mt_rand();
        }
        else{
            $noid = false;
        }
        echo "<div id=\"".$id ."\" >
                <div id=\"".$table."\" class=\"text ui-widget-content ui-corner-all\"> 
                <h1 class=\"ui-widget-header ui-corner-all\">".$table."</h3>
                <div id=\"form\" class=\"fltlft\">
                <form><p>";
        return $id;
        }
        


}