<?php
namespace views\seg;
class Document extends \libs\View {

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
                    <div id=\"document\" class=\"text ui-widget-content ui-corner-all\"> 
                    <h1 class=\"ui-widget-header ui-corner-all\">Document</h3>
                    <div id=\"form\" class=\"fltlft\">
                        <form><p>Namespace:
                            <input type=\"text\" name=\"namespace\" id=\"namespace\" placeholder=\"/name/space\" required=\"true\"/ class=\"text ui-widget-content ui-corner-all\"><br/>Description:<br/>
                            <textarea  cols=\"75\" rows=\"3\" name=\"description\" id=\"description\" placeholder=\"Describe the class's use\"class=\"text ui-widget-content ui-corner-all\"></textarea><br/>Code:<br/>
                            <textarea cols=\"75\" rows=\"10\" name=\"code\" id=\"code\" placeholder=\"Copy full code here\" class=\" text ui-widget-content ui-corner-all\"></textarea></p>
                        </form>
                    </div>
                    <div id=\"buttons\">
                        <div id=\"addfunc\"> Add a Function</div>
                        <div id=\"submit\" >Submit</div>
                                    <script>
$(function(){";
            if($noid==false){
                echo"var id = ".$id.";
                  $.get(\"".URL."seg/document/get/\"+id, function(data){              
                         $(\"#\"+id+\" > #document > #form  #namespace\").val(data.namespace);
                         $(\"#\"+id+\" > #document > #form  #description\").val(data.description);
                         $(\"#\"+id+\" > #document > #form  #code \").text(data.code);
                  });";
            }
            else{
                echo"var id;";
            }
            echo"
    $(\"#".$id." > #document > #buttons div\").button();

    $(\"#".$id." > #document > #buttons > #submit\").click(function(){
        var isgood = $(\"#".$id." > #document > #form #namespace\").val();
        if(isgood !=\"\"){ 
            $.ajax({
                type: 'POST',
                data: $(\"#".$id." > #document > #form form\").serialize(),
                url: \"" . URL . "seg/document/insert/\"+id,
                success: function(data){
                     $.get(\"".URL."seg/document/view/\"+data+\"/".$id."\",function(ret){
                         $(\"#".$id." > #document\").replaceWith(ret);
                             $(\"#".$id." #parent_submit\").click();
                        });";
                     if($noid == true){
                     echo"$.get(\"".URL."seg/document/input/rand\", function (ret){
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

   $(\"#".$id." > #document #addfunc\").click(function(){
          $.ajax({
                type: 'POST',
                data: $(\"#".$id." > #document > #form form\").serialize(),
                url: \"" . URL . "seg/document/insert/\"+id,
                success: function(data){
                    $.get(\"".URL."seg/document/input/data\", function(data){
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
    
    function view($id,$rapt){
        if($id == 0){//this is if it is updated without having the value change lastInsertId returns a 0
            $id = $rapt;
            $flag = 0;
        }
        if($rapt == "no"){
            echo "<div id=\"".$id."\">";
            $rapt = $id;
            $flag = 1;
        }
        else{
            $flag = 0;
        }
        echo"<div id=\"document\" class=\"ui-widget-content ui-corner-all\">
                <h2 id=\"namespace\" class=\"ui-widget-header ui-corner-all\"></h2>
                <div id=\"data\" class=\"fltlft\">
                    <p id=\"description\" class=\"textformat\">Description: </p><br>
                    Code: <div class=\"mar-left\" id=\"toggle_code\"></div><br/>
                    <div id=\"code\" class=\"code\" style=\"display: none\">no code here</div>                
                </div>
                <div id=\"buttons\">
                    <div class=\"mar-right\" id=\"edit\" title=\"Edit\"></div>
               </div>
                <script>
                    $(function(){
                        $.get(\"".URL."seg/document/get/".$id."\",function(data){
                            $(\"#".$rapt." > #document > h2#namespace \").text(data.namespace);
                            $(\"#".$rapt." > #document > #data  #description \").append(data.description);
                            $(\"#".$rapt." > #document > #data >#code \").text(data.code);
                        });
                        $(\"#".$rapt." > #document > #data #toggle_code\").button();
                        $(\"#".$rapt." > #document > #data #toggle_code\").text(\"show\");
                        $(\"#".$rapt." > #document > #data #toggle_code\").click(function(){
                            $(\"#".$rapt." > #document > #data > #code \").toggle(\"blind\",350);
                                if($(\"#".$rapt." > #document > #data #toggle_code\").text() == \"show\"){
                                    $(\"#".$rapt." > #document > #data #toggle_code\").text(\"hide\");
                                }
                                else{
                                $(\"#".$rapt." > #document > #data #toggle_code\").text(\"show\");
                                }
                        });
                                
                        $(\"#".$rapt." > #document > #buttons > #edit\").button({
                            icons:{
                                primary: \"ui-icon-gear\"
                            },
                            text: false
                        });
                        $(\"#".$rapt." > #document > #buttons > #edit\").click(function(){
                            $.get(\"".URL."seg/document/input/".$id."\",function(ret){
                                $(\"#".$rapt."\").replaceWith(ret);
                                    $(\"#".$id." #edit\").click();
                            });
                        });
                    });

                   </script>
               <div class=\"clearfloat\"></div>
           </div>";
if($flag == 1 ){
    echo"</div>";
}              
    }
}