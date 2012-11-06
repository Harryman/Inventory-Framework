var compatible = (function(){
    return{
        save:function(selector,p_id){
            $(selector).button({
                icons:{
            primary: icons.add
            },
            text: false
        });
        compatible.data(p_id,true);
        $(selector).attr('title','Save and Add');
        $(selector).closest('input').focus(function(){
            $(this).keypress(function(key){
                if(key.which == 13){
                    $(selector).click();
                }
            });
        });
        $(selector).on('click',function(event){
            var compat = $("#"+p_id+" > #compatible #compatible_id").val();
            $.ajax({
                type: 'POST',
                url: urlbase+"seg/compatible/insert",
                data: "p_id="+p_id+"&compatible_id="+compat,
                success: function(){
                    $("#"+p_id+" > #compatible > #data").remove();
                    compatible.data(p_id,true);
                }
            });
        });
        },
        data:function(p_id,button){
        $("#"+p_id+" > #compatible").append("<div id='data'></div>");
        $.getJSON(urlbase+"seg/compatible/get/"+p_id,function(json){
            $.each(json,function(i,n){
                $.getJSON(urlbase+"seg/product/get/"+n.compatible_id,function(data){
                    if(button == undefined){
                        $("#"+p_id+" > #compatible > #data").append("<div class='margin' id='"+n.compatible_id+"'><div>"+data.short_name+"</div></div>");
                    }
                    else{
                        $("#"+p_id+" > #compatible > #data").append("<div class='margin' id='"+n.compatible_id+"'><div class:'fltlft'>"+data.short_name+"<div/><div class='buttons'><div id='del'></div></div></div><div class='clearfloat'></div>");
                    }
                });
            });
            if(button == true){
                $("#"+p_id+" > #compatible > #data").ajaxStop(function(){
                    $("#"+p_id+" > #compatible #del").button({
                        icons:{
                            primary: icons.del
                        },
                        text: false
                    });
                    $("#"+p_id+" > #compatible #del").on('click',function(e){
                        var that = $(this);
                        compatible_id = $(this).parent().parent().parent().attr('id'); 
                        $.ajax({
                            type:'POST',
                            url: urlbase+"seg/compatible/delete",
                            data: "p_id="+p_id+"&compatible_id="+compatible_id,
                            success: function(){
                                $(that).parent().parent().parent().remove();
                            }
                        });
                    });
                });
            }
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
                $.get(urlbase+"/seg/compatible/edit/"+p_id,function(data){
                    $("#"+p_id+" > #compatible").replaceWith(data);
                });
            });
        }
    }
    })();