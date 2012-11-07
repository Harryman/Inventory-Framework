var pic = (function(){
    return{
        upload:function(p_id){
            $("#"+p_id+" > #pic #upload").button();
            $("#"+p_id+" > #pic #upload").on('click',function(){
                var fd = new FormData($("#"+p_id+" > #pic form")[0]);
                $.ajax({
                    url: urlbase+"seg/pic/upload",
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#"+p_id+" > #pic #data").replaceWith(pic.data(p_id));
                        $()
                    }
                });
            });
         },
         data:function(p_id){
            $("#"+p_id+" > #pic").append("<div id=\"data\"><div class=\"clearfloat\"></div></div>");
             $.getJSON(urlbase+"seg/pic/get/"+p_id,function(json){
                 $.each(json, function(i,n){
                     if(n.primary == 1){
                        $("#"+p_id+" > #pic #data").prepend("<div class='fltlft margin' id='"+n.id+"'><div id='btns'>Primary <div id=\"del\" title=\"delete from database\"></div></div><a href='"+urlbase+"uploads/images/product/"+n.id+".jpg' target='_blank'><img title='"+n.id+"' src='"+urlbase+"uploads/images/product/"+n.id+"_125.jpg' alt='"+n.id+"'></a></div>");
                     }
                     else{
                        $("#"+p_id+" > #pic #data").prepend("<div class='fltlft margin' id='"+n.id+"'><div id='btns'><div title=\"set as primary display picture\" id=\"primary\"></div><div id=\"del\" title=\"delete from database\"></div></div><a href='"+urlbase+"uploads/images/product/"+n.id+".jpg' target='_blank'><img title='"+n.id+"' src='"+urlbase+"uploads/images/product/"+n.id+"_125.jpg' alt='"+n.id+"'></a></div>");
                     }
                 })
                 $("#"+p_id+" > #pic #data  #btns").buttonset();
                 $("#"+p_id+" > #pic #data  #btns > #del").button({
                    icons:{
                        primary: icons.del
                        },
                        text: false
                    }); 
                 $("#"+p_id+" > #pic #data #btns #del").click(function(){
                     delid = $(this).parent().parent().attr('id');
                     $.ajax({
                         type:'POST',
                         url: urlbase+"seg/pic/delete",
                         data: "id="+delid,
                         success: function(){
                             $("#"+p_id+" > #pic #data > #"+delid).remove();
                         }
                     })
                 })
                
                 $("#"+p_id+" > #pic #data #btns #primary").button({
                    icons:{
                        primary: icons.primary
                        },
                        text: false
                });    
                
                 $("#"+p_id+" > #pic #data #btns #primary").click(function(){
                     upid = $(this).parent().parent().attr('id');
                     $.get(urlbase+"seg/pic/update/"+upid+"/"+p_id,function(){
                         $("#"+p_id+" > #pic #data > #"+upid+" > #btns > #primary").replaceWith("Primary");
                     });
                 });
             })
         },
        initPrime:function(selector,p_id){            
            $(selector).button({
                icons:{
            primary: icons.save
            },
            text: false
        });
        
        $(selector).attr('title','Save Currently set as primary');
        $(selector).on('click',function(event){
            var compat = $("#"+p_id+" > #pic ").val();
            $.ajax({
                type: 'POST',
                url: urlbase+"seg/pic/insert",
                data: "p_id="+p_id+"&loc_id="+compat,
                success: function(){
                    $("#"+p_id+" > #pic > #data").remove();
                    pic.data(p_id,true);
                }
            });
        });
        },
        edit:function(selector,p_id){
            $(selector).button({
                icons:{
                    primary: icons.edit
                },
                text: false 
            });
            $(selector).on('click',function(){
                $.get(urlbase+"/seg/pic/edit/"+p_id,function(data){
                    $("#"+p_id+" > #pic").replaceWith(data);
                });
            });
        }
    }
    })();