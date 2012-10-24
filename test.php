<html>
    <head>
        <?php require 'config/paths.php';?>
        <script src="<?php echo URL; ?>jquery/jquery-1.8.2.min.js" ></script>

    <body>
        <div> this is div</div>
        <?php
        ?>
        <script> alert("this is stupid");</script>
        <script>
            alert("we are really fucked");
            $.get('<?php echo URL; ?>addpart/other',function(ret){
                alert(ret);
            });
           // })
           // $(function(){
            //    $.ajax({
             //       url: '<?php echo URL; ?>addpart/other',
             //       success:function(ret){
              //         alert(ret);
               //      }
              //  });
            //           alert("its fucked");
            //}
                 
        </script>
    </body>
</html>

