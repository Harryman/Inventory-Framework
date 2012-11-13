var external_pn = (function(){
      var defView = "external_pn/default.html";
    return{
        add:function(p_id){
            $("#"+p_id+" > #external_pn > h3 .buttons").append("<button id='add'></button>");
            $("#"+p_id+" > #external_pn > h3 #add")
                .button({
                    icons:{
                        primary: icons.add
                    },
                    text:false
                })
                .click(function(){
                    external_pn.edit(false, p_id)
                });
        },
        edit:function(id,p_id){
            if(id == false){
                $.get(urlbase+"seg/external_pn/getnextid",function(data){
                    var json = $.parseJSON('{"0":{"id":"'+data+'","p_id":"'+p_id+'"}}')
                    if($("#"+p_id+" > #external_pn > #data > #"+data).length > 0){
                        alert("You must save the last one you added before you can add another!");
                    }
                    else{
                        $("#"+p_id+" > #external_pn > #data").prepend(editView("external_pn", json, p_id));
                        $("#"+p_id+" > #external_pn > #data > #"+data).hide();
                        $("#"+p_id+" > #external_pn > #data > #"+data).slideDown();
                        id = data;
                        prodAC();
                        $("#"+p_id+" > #external_pn > #data > #"+id+" .buttons")
                        btn = new Fbtn("external_pn",p_id,id);
                        btn.cancel(false);
                        btn.save(defView);
                    }
                });
            }
            else{
                $.get(urlbase+"seg/external_pn/getdata/"+id,function(json){
                    $("#"+p_id+" > #external_pn > #data > #"+id).slideUp(function(){
                        $("#"+p_id+" > #external_pn > #data > #"+id).replaceWith(editView("external_pn", json));
                        $("#"+p_id+" > #external_pn > #data > #"+id).hide();
                        $("#"+p_id+" > #external_pn > #data > #"+id).slideDown();             
                        btn = new Fbtn("external_pn",p_id,id);
                        btn.del();
                        btn.cancel(false);
                        btn.save(defView);
                    });
                });
            }
        },
        save:function(id, p_id){
            $.get(urlbase+"seg/external_pn/getData/"+id, function(json){
                $("#"+p_id+" > #external_pn > #data #"+id).slideUp(function(){
                        $("#"+p_id+" > #external_pn > #data #"+id).replaceWith(dataView(defView, json));
                        $("#"+p_id+" > #external_pn > #data #"+id).hide();
                        $("#"+p_id+" > #external_pn > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        cancel:function(id,p_id){
            $("#"+p_id+" > #external_pn > #data #"+id)
                .slideUp(function(){
                    $.get(urlbase+"seg/external_pn/getdata/"+id,function(json){
                    $("#"+p_id+" > #external_pn > #data #"+id).replaceWith(dataView(defView,json)); 
                    $("#"+p_id+" > #external_pn > #data #"+id).hide();
                    $("#"+p_id+" > #external_pn > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        data:function(p_id, single){
            if(single == undefined){
                $.get(urlbase+"seg/external_pn/getAllData/"+p_id, function(json){
                    $("#"+p_id+" > #external_pn > #data").append(dataView(defView,json));
                    btn = new Fbtn("external_pn",p_id);
                    btn.edit();
                });
            }
            else{
                $.get(urlbase+"seg/external_pn/getData/"+p_id, function(json){
                    $("#"+p_id+" > #external_pn > #data").append(dataView(defView,json));
                    btn = new Fbtn("external_pn",p_id);
                    btn.edit();
                });
                
            }
        }
    }
    })();
