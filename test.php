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
        <? 
        
        $grr = null;
        if(!$grr){
            echo "grr isset";
        }
        echo $grr;
        ?>
        <div id="header"></div>
        <div class="container" id="content">
        </body>
        </html>