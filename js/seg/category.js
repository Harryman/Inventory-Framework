$(function(){
    var divs;
    $.get(urlbase+'seg/category/data',function(durr){
        $.getJSON(urlbase+'seg/category/getcats',function(data){
            $.each(data[0],function(l){
                $("#root").append("<div id=\""+l+"\">"+durr+"</div>");
                $.each(data[0][l],function(k,v){
                    $("#"+l+" > #data  #"+k).append(v);
                })
            });
        });
    });
});