var assembly = (function(){
      var defView = "assembly/default.html";
    return{
        add:function(p_id){
            $("#"+p_id+" > #assembly > h3 .buttons").append("<button id='add'></button>");
            $("#"+p_id+" > #assembly > h3 #add")
                .button({
                    icons:{
                        primary: icons.add
                    },
                    text:false
                })
                .click(function(){
                    assembly.edit(false, p_id)
                });
        },
        edit:function(id,p_id){
            if(id == false){
                $.get(urlbase+"seg/assembly/getnextid",function(data){
                    var json = $.parseJSON('{"0":{"id":"'+data+'","p_id":"'+p_id+'"}}')
                    if($("#"+p_id+" > #assembly > #data > #"+data).length > 0){
                        alert("You must save the last one you added before you can add another!");
                    }
                    else{
                        $("#"+p_id+" > #assembly > #data").prepend(editView("assembly", json, p_id));
                        $("#"+p_id+" > #assembly > #data > #"+data).hide();
                        $("#"+p_id+" > #assembly > #data > #"+data).slideDown();
                        id = data;
                        prodAC();
                        $("#"+p_id+" > #assembly > #data > #"+id+" .buttons")
                        btn = new Fbtn("assembly",p_id,id);
                        btn.cancel(false);
                        btn.save(defView);
                    }
                });
            }
            else{
                $.get(urlbase+"seg/assembly/getdata/"+id,function(json){
                    $("#"+p_id+" > #assembly > #data > #"+id).slideUp(function(){
                        $("#"+p_id+" > #assembly > #data > #"+id).replaceWith(editView("assembly", json));
                        $("#"+p_id+" > #assembly > #data > #"+id).hide();
                        $("#"+p_id+" > #assembly > #data > #"+id).slideDown();             
                        btn = new Fbtn("assembly",p_id,id);
                        btn.del();
                        btn.cancel(false);
                        btn.save(defView);
                    });
                });
            }
        },
        save:function(id, p_id){
            $.get(urlbase+"seg/assembly/getData/"+id, function(json){
                $("#"+p_id+" > #assembly > #data #"+id).slideUp(function(){
                        $("#"+p_id+" > #assembly > #data #"+id).replaceWith(dataView(defView, json));
                        $("#"+p_id+" > #assembly > #data #"+id).hide();
                        $("#"+p_id+" > #assembly > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        cancel:function(id,p_id){
            $("#"+p_id+" > #assembly > #data #"+id)
                .slideUp(function(){
                    $.get(urlbase+"seg/assembly/getdata/"+id,function(json){
                    $("#"+p_id+" > #assembly > #data #"+id).replaceWith(dataView(defView,json)); 
                    $("#"+p_id+" > #assembly > #data #"+id).hide();
                    $("#"+p_id+" > #assembly > #data #"+id).slideDown();
                        btn.edit();
                    });
                });
        },
        data:function(p_id, single){
            if(single == undefined){
                $.get(urlbase+"seg/assembly/getAllData/"+p_id, function(json){
                    $("#"+p_id+" > #assembly > #data").append(dataView(defView,json));
                    btn = new Fbtn("assembly",p_id);
                    btn.edit();
                });
            }
            else{
                $.get(urlbase+"seg/assembly/getData/"+p_id, function(json){
                    $("#"+p_id+" > #assembly > #data").append(dataView(defView,json));
                    btn = new Fbtn("assembly",p_id);
                    btn.edit();
                });
                
            }
        }
    }
    })();
