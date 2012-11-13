var part = (function(){
      var defView = "part/default.html";
    return{
        add:function(p_id){
            $("#"+p_id+" > #part > h3 .buttons").append("<button id='add'></button>");
            $("#"+p_id+" > #part > h3 #add")
                .button({
                    icons:{
                        primary: icons.add
                    },
                    text:false
                })
                .click(function(){
                    part.edit(false, p_id)
                });
        },
        edit:function(id,p_id){
            if(id == false){
                $.get(urlbase+"seg/part/getnextid",function(data){
                    var json = $.parseJSON('{"0":{"id":"'+data+'","p_id":"'+p_id+'"}}')
                    if($("#"+p_id+" > #part > #data > #"+data).length > 0){
                        alert("You must save the last one you added before you can add another!");
                    }
                    else{
                        $("#"+p_id+" > #part > #data").prepend(editView("part", json, p_id));
                        $("#"+p_id+" > #part > #data > #"+data).hide();
                        $("#"+p_id+" > #part > #data > #"+data).slideDown();
                        id = data;
                        prodAC();
                        $("#"+p_id+" > #part > #data > #"+id+" .buttons")
                        btn = new Fbtn("part",p_id,id);
                        btn.cancel(false);
                        btn.save(defView);
                    }
                });
            }
            else{
                $.get(urlbase+"seg/part/getdata/"+id,function(json){
                    $("#"+p_id+" > #part > #data > #"+id).slideUp(function(){
                        $("#"+p_id+" > #part > #data > #"+id).replaceWith(editView("part", json));
                        $("#"+p_id+" > #part > #data > #"+id).hide();
                        $("#"+p_id+" > #part > #data > #"+id).slideDown();             
                        btn = new Fbtn("part",p_id,id);
                        btn.del();
                        btn.cancel(false);
                        btn.save(defView);
                    });
                });
            }
        },
        save:function(id, p_id){
            $.get(urlbase+"seg/part/getData/"+id, function(json){
                $("#"+p_id+" > #part > #data #"+id).slideUp(function(){
                        $("#"+p_id+" > #part > #data #"+id).replaceWith(dataView(defView, json));
                        $("#"+p_id+" > #part > #data #"+id).hide();
                        $("#"+p_id+" > #part > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        cancel:function(id,p_id){
            $("#"+p_id+" > #part > #data #"+id)
                .slideUp(function(){
                    $.get(urlbase+"seg/part/getdata/"+id,function(json){
                    $("#"+p_id+" > #part > #data #"+id).replaceWith(dataView(defView,json)); 
                    $("#"+p_id+" > #part > #data #"+id).hide();
                    $("#"+p_id+" > #part > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        data:function(p_id, single){
            if(single == undefined){
                $.get(urlbase+"seg/part/getAllData/"+p_id, function(json){
                    $("#"+p_id+" > #part > #data").append(dataView(defView,json));
                    btn = new Fbtn("part",p_id);
                    btn.edit();
                });
            }
            else{
                $.get(urlbase+"seg/part/getData/"+p_id, function(json){
                    $("#"+p_id+" > #part > #data").append(dataView(defView,json));
                    btn = new Fbtn("part",p_id);
                    btn.edit();
                });
                
            }
        }
    }
    })();
