var prod_cat = (function(){

return{
    menu: function(selector,selmenu,p_id){
            $(selector).ajaxStop(function(){
                $(selmenu).menu({
                    select: function(event,ui){
                        var valid = ui.item.attr("title");
                        if(valid != "bottom level"){
                            alert("you must select a bottom level category");
                        }
                        else{
                            var clkd = ui.item.attr("id");
                            if(p_id == undefined){
                                p_id = $("input#p_id").val();
                            }
                            $.ajax({
                                type: 'POST',
                                url: urlbase+"seg/prod_cat/insert/",
                                data: "p_id="+p_id+"&cat_id="+clkd,
                                success: function(){
                                    $("#"+p_id+" > #prod_cat > #data").remove();
                                    prod_cat.data(p_id,true);
                                }
                            });
                        }
                    }
                });
            });
        },
    data:function(p_id,button){
        $("#"+p_id+" > #prod_cat").append("<div id='data'></div>");
        $.getJSON(urlbase+"seg/prod_cat/get/"+p_id,function(json){
            $.each(json,function(i,n){
                $.getJSON(urlbase+"seg/category/getParents/"+n.cat_id, function(data){
                    var str;
                    $.each(data,function(i,d){
                        if(str == undefined){
                        str = "> "+d[0]
                        }
                        else{
                        str = "> "+d[0]+" "+str;
                        }
                    })
                    if(button == undefined){
                        $("#"+p_id+" > #prod_cat > #data").append("<div class='margin' id='"+n.cat_id+"'><div>"+str+"</div></div>");
                    }
                    else{
                        $("#"+p_id+" > #prod_cat > #data").append("<div class='margin' id='"+n.cat_id+"'><div class:'fltlft'>"+str+"<div/><div class='buttons'><div id='del'></div></div></div><div class='clearfloat'></div>");
                    }
                })
            });
        });
        $("#"+p_id+" > #prod_cat > #data").ajaxStop(function(){
            $("#"+p_id+" > #prod_cat #del").button({
                icons:{
                    primary: icons.del
                },
                text: false
            });
            $("#"+p_id+" > #prod_cat #del").on('click',function(e){
                var that = $(this);
                cat_id = $(this).parent().parent().parent().attr('id'); 
                $.ajax({
                    type:'POST',
                    url: urlbase+"seg/prod_cat/delete",
                    data: "p_id="+p_id+"&cat_id="+cat_id,
                    success: function(){
                        $(that).parent().parent().parent().remove();
                    }
                });
            });
        });
    }
    };
})();