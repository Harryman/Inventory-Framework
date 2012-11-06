var related = (function(){
    return{
        save:function(selector,p_id){
            $(selector).button({
                icons:{
            primary: icons.add
            },
            text: false
        });
        related.data(p_id,true);
        $(selector).attr('title','Save and Add');
        $(selector).closest('input').focus(function(){
            $(this).keypress(function(key){
                if(key.which == 13){
                    $(selector).click();
                }
            });
        });
        $(selector).on('click',function(event){
            var compat = $("#"+p_id+" > #related #related_id").val();
            $.ajax({
                type: 'POST',
                url: urlbase+"seg/related/insert",
                data: "p_id="+p_id+"&related_id="+compat,
                success: function(){
                    $("#"+p_id+" > #related > #data").remove();
                    related.data(p_id,true);
                }
            });
        });
        },
        data:function(p_id,button){
        $("#"+p_id+" > #related").append("<div id='data'></div>");
        $.getJSON(urlbase+"seg/related/get/"+p_id,function(json){
            $.each(json,function(i,n){
                $.getJSON(urlbase+"seg/product/get/"+n.related_id,function(data){
                    if(button == undefined){
                        $("#"+p_id+" > #related > #data").append("<div class='margin' id='"+n.related_id+"'><div>"+data.short_name+"</div></div>");
                    }
                    else{
                        $("#"+p_id+" > #related > #data").append("<div class='margin' id='"+n.related_id+"'><div class:'fltlft'>"+data.short_name+"<div/><div class='buttons'><div id='del'></div></div></div><div class='clearfloat'></div>");
                    }
                });
            });
            if(button == true){
                $("#"+p_id+" > #related > #data").ajaxStop(function(){
                    $("#"+p_id+" > #related #del").button({
                        icons:{
                            primary: icons.del
                        },
                        text: false
                    });
                    $("#"+p_id+" > #related #del").on('click',function(e){
                        var that = $(this);
                        related_id = $(this).parent().parent().parent().attr('id'); 
                        $.ajax({
                            type:'POST',
                            url: urlbase+"seg/related/delete",
                            data: "p_id="+p_id+"&related_id="+related_id,
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
                $.get(urlbase+"/seg/related/edit/"+p_id,function(data){
                    $("#"+p_id+" > #related").replaceWith(data);
                });
            });
        }
    }
    })();