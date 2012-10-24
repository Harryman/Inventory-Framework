<?php
namespace views\seg;
class TEMPLATE extends \libs\View {

    function __construct() {
        parent::__construct();
    }
    
    function input($id){
        if ($id == "rand") {
            $noid = true;
            $id = mt_rand();
        }
        else{
            $noid = false;
        }
            echo "<div id=\"".$id ."\" >
                    <div id=\"TEMPLATE\" class=\"text ui-widget-content ui-corner-all\"> 
                    <h1 class=\"ui-widget-header ui-corner-all\">TEMPLATE</h3>
                    <div id=\"form\" style=\"float:left;\">
                        <form><p>Namespace:
                            <input type=\"text\" name=\"namespace\" id=\"namespace\" placeholder=\"/name/space\" required=\"true\"/ class=\"text ui-widget-content ui-corner-all\"><br/>Description:<br/>
                            <textarea  cols=\"75\" rows=\"3\" name=\"description\" id=\"description\" placeholder=\"Describe the class's use\"class=\"text ui-widget-content ui-corner-all\"></textarea></p>
                        </form>
                    </div>
                    <div id=\"buttons\">
                        <div id=\"addfunc\"> Add a Function</div>
                        <div id=\"submit\" >Submit</div>
                                    <script>
$(function(){";
            if($noid==false){
                echo"var id = ".$id.";
                  $.get(\"".URL."seg/TEMPLATE/get/\"+id, function(data){              
                         $(\"#\"+id+\" > #TEMPLATE > #form  #namespace\").val(data.namespace);
                         $(\"#\"+id+\" > #TEMPLATE > #form  #description\").val(data.description);
                  });";
            }
            else{
                echo"var id;";
            }
            echo"
    $(\"#".$id." > #TEMPLATE > #buttons div\").button();

    $(\"#".$id." > #TEMPLATE > #buttons > #submit\").click(function(){
        var isgood = $(\"#".$id." > #TEMPLATE > #form > form > #namespace\").val();
        if(isgood != \"\"){
            $.ajax({
                type: 'POST',
                data: $(\"#".$id." > #TEMPLATE > #form form\").serialize(),
                url: \"" . URL . "seg/TEMPLATE/insert/\"+id,
                success: function(data){
                     $.get(\"".URL."seg/TEMPLATE/show/\"+data+\"/".$id."\",function(ret){
                         $(\"#".$id." > #TEMPLATE\").replaceWith(ret);
                             $(\"#".$id." #parent_submit\").click();
                        });";
                     if($noid == true){
                     echo"$.get(\"".URL."seg/TEMPLATE/input/rand\", function (ret){
                         $(\".container\").prepend(ret);                      
                        });";
                     }
                     echo"
                }
          });
        }
        else{
            alert(\"Namespace is required\");
        }
    });

   $(\"#".$id." > #TEMPLATE #addfunc\").click(function(){
          $.ajax({
                type: 'POST',
                data: $(\"#".$id." > #TEMPLATE > #form form\").serialize(),
                url: \"" . URL . "seg/TEMPLATE/insert/\"+id,
                success: function(data){
                    $.get(\"".URL."seg/TEMPLATE/input/data\", function(data){
            });
        
        $.get(\"".URL."seg/doc_function/input/\", function(data){
             $(\"#content\").remove();
        });
        }
   });
});
});
        </script>
                    </div>
                <p style=\"display: block; clear: both\"></p>
                </div>
            </div>";
    }
    
    function show($id,$rapt){
        if($id == 0){
            $id = $rapt;
        }
        if($rapt == "no"){
            echo "<div id=\"".$id."\"class=\"ui-widget-content ui-corner-all\")>";
            }
        echo"<div id=\"TEMPLATE\" class=\"ui-widget-content ui-corner-all\">
                <h2 id=\"namespace\" class=\"ui-widget-header ui-corner-all\"></h2>
                <div id=\"data\" class=\"fltlft\">
                    <p id=\"description\">Description: </p>
                </div>
                <div id=\"buttons\">
                    <div id=\"edit\" class=\"ui-state-default ui-corner-all\" title=\"Edit\">
                    <span class=\"ui-icon ui-icon-gear\"></span>
                    <script>
                    $(function(){
                        $.get(\"".URL."seg/TEMPLATE/get/".$id."\",function(data){
                            $(\"#".$rapt." > #TEMPLATE > #namespace \").text(data.namespace);
                            $(\"#".$rapt." > #TEMPLATE  #description \").append(data.description);
                        });
                                
                        $(\"#".$rapt." > #TEMPLATE > #buttons > #edit\").button();
                        $(\"#".$rapt." > #TEMPLATE > #buttons > #edit\").click(function(){
                            $.get(\"".URL."seg/TEMPLATE/input/".$id."\",function(ret){
                                $(\"#".$rapt."\").replaceWith(ret);
                                    $(\"#".$id." #edit\").click();
                            });
                        });
                    });

                   </script>
                   </div>
               </div>
               <p style=\"display: block; clear: both\"></p>
           </div>";
if($rapt == 0 ){
    echo"</div>";
}
                
               
    }
}