<html>
    <head>
        <? require_once("/config/paths.php");?> 
        <link rel="stylesheet" href="<? echo URL;?>jqueryui/css/custom-theme/jquery-ui-1.9.0.custom.min.css"/>
        <link rel="stylesheet" href="<?= URL;?>css/default.css"/>
        <script src="<? echo URL;?>jquery/jquery-1.8.2.min.js"></script>
        <script src="<? echo URL;?>jqueryui/js/jquery-ui-1.9.0.custom.min.js"></script>
        <script>$.uiBackCompat = false;</script>
        <script src="<?=URL;?>js/common.js"></script>
    </head>
    <body>
        <? $array = array("add","edit","delete","submit");
 $out = json_encode($array,JSON_FORCE_OBJECT);
 var_dump($array); 
 var_dump($out);
 echo"<script>var out = ".$out.";
     
     $.each(out, function(i,val){
     alert(val)
     });
     </script>";
        ?>
        <div id="header"></div>
        <div class="container" id="content">
        </body>
        </html>