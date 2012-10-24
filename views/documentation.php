<?php
namespace views;

class Documentation extends \libs\View {

    function __construct() {
        parent::__construct();
    }
    function search(){
        echo"<div id=\"search_document\" class=\" pad ui-widget-header ui-corner-all\">
                    <input class=\" fltlft ui-widget-content ui-corner-all\" type=\"text\" id=\"search\" length=\"150\" placeholder=\"Search by namespace\"></input>
                    <div class=\" fltlft\" id=\"search_submit\">Go</div>
                    <div class=\" fltrt\" id=\"add\" title=\"Add a new document to the documentation\"><a href=\"".URL."documentation/add\">Add Document</a></div>
                    <div class=\"clearfloat\"></div>
                    </div>
            <script>
            var doc_ac;
            $(function(){
            $(\"#search_document  #search\").autocomplete({
                source:\"".URL."documentation/ac/\"
            });
            $(\"#search_document  #search\").focus(function(){
                $(\"#search_document  #search\").keypress(function(key){
                    if(key.which == 13){
                        $(\"#search_document  #search_submit\").click();
                    }
                });
            });
            $(\"#search_document  #search_submit\").button();
            $(\"#search_document  #search_submit\").click(function(){
               doc_ac = $(\"#search_document  #search\").val();
                window.location = \"".URL."documentation/view/\"+doc_ac ;
            });
            });
            </script>";
    }
}