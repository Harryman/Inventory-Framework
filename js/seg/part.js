var part = (function(){
    return{
        add:function(p_id){
            $("#"+p_id+" > #part > h3 .buttons").append("<div id='add'></div>");
            $("#"+p_id+" > #part > h3 #add").button({
                icons:{
                    primary: icons.add
                },
                text:false
            });
            $("#"+p_id+" > #part > h3 #add").click(function(){
                part.edit(p_id,true)
            });
        },
        edit:function(id,p_id,isfkey){
            if(isfkey == true){
                $.get(urlbase+"seg/part/getnextid",function(data){
                    if($("#"+p_id+" > #part > #data > #"+data).length > 0){
                        alert("You must save the last one you added before you can add another!");
                    }
                    else{
                    $("#"+p_id+" > #part > #data")
                        .prepend(editView({"id":""+data+"","p_id":""+p_id+"","product_id":"","qty":""}));
                    $("#"+p_id+" > #part > #data > #"+data)
                        .hide()
                        .slideDown();
                    }
                });
                id = data;
            }
            else{
                $.get(urlbase+"seg/part/getdata/"+id,function(json){
                    $("#"+id+" > #part > #data > #"+id)
                        .slideUp()
                        .replaceWith(editView(json))
                        .hide()
                        .slideDown();
                });
            }
            $("#"+p_id+" > #part > #data > #"+id+" .buttons")
                .append("<div id='del'></div><div id='cancel'></div><div id='save'></div>")
                .buttonset();
            $("#"+p_id+" > #part > #data > #"+id+" #del")
                .button({
                    icons:{
                            primary: icons.del
                        },
                    text: false
                })
                .click(function(){
                    $.ajax({
                        type:'POST',
                        url: urlbase+"/seg/part/delete",
                        data: "id="+id,
                        success: function(){
                             $("#"+id+" > #part > #data > #"+id)
                                .slideUp()
                                .remove();
                        }
                    });
                });
            $("#"+id+" > #part > #data > #"+id+" #cancel")
                .button({
                    icons:{
                            primary: icons.cancel
                        },
                    text: false
                })
                .click(function(){
                    $("#"+id+" > #part > #data > #"+id)
                        .slideUp()
                        .replaceWith(part.data)
                        .hide()
                        .slideDown();
            });
            $("#"+id+" > #part > #data > #"+id+" #save")
                .button({
                    icons:{
                            primary: icons.save
                        },
                    text: false
                })
                .click(function(){
                    if(validator(p_id)){
                        $.ajax({
                            type:'POST',
                            url: urlbase+"/seg/part/insert",
                            data:  $("#"+id+" > #part > #data > #"+id).serialize(),
                            success: function(){
                                 $("#"+id+" > #part > #data > #"+id)
                                    .slideUp()
                                    .replaceWith(part.data(id, true))
                                    .hide()
                                    .slideDown();
                            }
                        });
                    }
            });
        },
        data:function(id, iskey){
            if(iskey == true){
                $(get(urlbase+"seg/part/getData/"+id, function(json){
                    $a
                }))
                
            }
        },
        editView:function(json){
      var out = "<div id='"+json.id+"'>\n\
                     <div class='buttons'></div>\n\
                     Part Number of part: <input type='text' class='prodac ui-corner-all ui-widget-content' name='product_id' id='product_id' value='"+json.product_id+"' placeholder='Part id'/><br/>\n\
                     Quantity required for assembly: <input type='text' class='ui-widget-content ui-corner-all' name='qty' id='qty' value='"+json.qty+"'/>\n\
                     <input type='hidden' name='p_id' value='"+json.p_id+"'/>\n\
                     <input type='hidden' name='id' value='"+json.id+"'/>\n\
                     <div class='clearfloat'></div>\n\
                 <div>";
            return
        }
        dataView:function(json){
            
        }
        
        
    }
    })();