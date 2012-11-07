var prod_loc = (function(){
    return{
        save:function(selector,p_id){
            $(selector).button({
                icons:{
            primary: icons.add
            },
            text: false
        });
        prod_loc.data(p_id,true);
        $(selector).attr('title','Save and Add');
        $(selector).closest('input').focus(function(){
            $(this).keypress(function(key){
                if(key.which == 13){
                    $(selector).click();
                }
            });
        });
        $(selector).on('click',function(event){
            var compat = $("#"+p_id+" > #prod_loc #id").val();
            $.ajax({
                type: 'POST',
                url: urlbase+"seg/prod_loc/insert",
                data: "p_id="+p_id+"&id="+compat,
                success: function(){
                    $("#"+p_id+" > #prod_loc > #data").remove();
                    prod_loc.data(p_id,true);
                }
            });
        });
        },
        data:function(p_id,button){
        $("#"+p_id+" > #prod_loc").append("<div id='data'></div>");
        $.getJSON(urlbase+"seg/prod_loc/get/"+p_id,function(json){
            $.each(json,function(i,n){
                    if(button == undefined){
                        $("#"+p_id+" > #prod_loc > #data").append("<div class='margin' id='"+n.id+"'><div>"+n.id+"</div></div>");
                    }
                    else{
                        $("#"+p_id+" > #prod_loc > #data").append("<div class='margin' id='"+n.id+"'><div class:'fltlft'>"+n.id+"<div/><div class='buttons'><div id='del'></div></div></div><div class='clearfloat'></div>");
                    }
            });
            if(button == true){
                $("#"+p_id+" > #prod_loc > #data").ajaxStop(function(){
                    $("#"+p_id+" > #prod_loc #del").button({
                        icons:{
                            primary: icons.del
                        },
                        text: false
                    });
                    $("#"+p_id+" > #prod_loc #del").on('click',function(e){
                        var that = $(this);
                        id = $(this).parent().parent().parent().attr('id'); 
                        $.ajax({
                            type:'POST',
                            url: urlbase+"seg/prod_loc/delete",
                            data: "p_id="+p_id+"&id="+id,
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
                $.get(urlbase+"/seg/prod_loc/edit/"+p_id,function(data){
                    $("#"+p_id+" > #prod_loc").replaceWith(data);
                });
            });
        }
    }
    })();