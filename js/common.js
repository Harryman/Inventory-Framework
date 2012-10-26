function Btnset(id,table,container){
    this.id = id;
    this.table = table;
    this.container = container;
    this.btncon = "#"+id+" > #"+table+" > "+container;
    this.seccon = "#"+id+" > #"+table;
    $(this.btncon).buttonset();
}

Btnset.prototype.add = function(callback, title, fkey){
    this.addCallback = callback;
    this.addTitle = title;
    this.addFkey = fkey;
    $(this.btncon).append("<div id=\"add\"></div>");
    btn = this.btncon+" > #add";
    if(!title){
        $(btn).attr("title", "add");
    }
    else{
        $(btn).attr("title",title);
    }
    $(btn).button({
        icons:{
            primary: icons.add
        },
        text: false
    });
     $(btn).click(function(){
         if(!fkey){
                $.ajax({
                    type: 'POST',
                    data: $("#"+this.id+" > #"+this.table+" > #form form").serialize(),
                    url: url+"seg/"+this.table+"/insert/"+id,
                    success: function(data){
                        $.get(url+"seg/"+callback+"/add/rand/"+data, function(seg){
                            $(this.seccon).append(seg);
                        });
                    }
                }); 
         }
         else{
            $.get(url+"seg/"+callback+"/rand/"+fkey, function(seg){
                $(this.seccon).append(seg);
            });
         }
     });
}

Btnset.prototype.edit = function(){
    $(this.btncon).append("<div id=\"edit\" title=\"edit\"></div>");
    btn = this.btncon+" > #edit";
    $(btn).button({
        icons:{
            primary: icons.edit
        },
        text: false
    });
    $(btn).click(function(){
        $.get(url+"seg/"+this.table+"/edit/"+this.id ,function(data){
            $(this.seccon+" > #data").replaceWith(data);
        });
        $(this.btncon).children().remove();
        this.del(id);
        this.cancel(id);
        this.add(this.addCallback,this.addTitle,this.addFkey);
        this.submit(id);   
    });        
}
Btnset.prototype.cancel = function(){
    $(this.btncon).append("<div id=\"cancel\" title=\"cancel\"></div>");
    btn = this.btncon+" > #cancel";
    $(btn).button({
        icons:{
            primary: icons.cancel
        },
        text: false
    });
    $(btn).click(function(){
        $.get(url+"seg/"+this.table+"/data/"+this.id ,function(data){
            $(this.seccon+" > #data").replaceWith(data);
        });
        $(this.btncon).children().remove();
        this.edit();
    });        
}

Btnset.prototype.del = function(){
        $(this.btncon).append("<div id=\"delete\" title=\"delete\"></div>");
    btn = this.btncon+" > #delete";
    $(btn).button({
        icons:{
            primary: icons.del
        },
        text: false
    });
    $(btn).click(function(){
        $.get(url+"seg/"+this.table+"/delete/"+this.id ,function(data){
            $(this.seccon+" > #data").replaceWith(data);
        });
        $(this.btncon).children().remove();
        this.del(id);
        this.cancel(id);
        this.add(this.addCallback,this.addTitle,this.addFkey);
        this.submit(id);   
    });        
}
}

function inhrt(o){
    function F(){};
    F.prototype = o;
    return new F();
}

function startButton(id, table, add, btns){
    $("#"+id+" > "+table+" > h2 > .buttons").buttonset();
    $.each(btns, function(i, val){
         $("#"+id+" > "+table+" > h2 > .buttons > #"+val).button({
             icons:{
                    primary: icons.val
                    },
             text: false
         });
         if(val == "add"){
            $("#"+id+" > "+table+" > h2 > .buttons > #"+val).click(function(){
                $.ajax({
                    type: 'POST',
                    data: $("#"+id+" > #"+table+" > #form form").serialize(),
                    url: URL+"seg/"+table+"/insert/"+id,
                    success: function(data){
                        $.get(\"".URL."seg/document/input/data\", function(data){
                    });    
            });
         }
         $("#"+id+" > "+table+" > h2 > .buttons > #"+val).click(function(){
             
         })
    });
    $("#"+id+" > "+table+" > h2 > .buttons").buttonset();
}