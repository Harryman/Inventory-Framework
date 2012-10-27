function Btnset(idr,table,container){
    this.id = idr;
    this.dbid;
    if(this.id < 100000000){
        this.dbid = this.id;
    }
    this.table = table;
    this.container = container;
    this.btncon = "#"+this.id+" > #"+table+" > "+container;
    this.seccon = "#"+this.id+" > #"+table;
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
         if(!this.addFkey){
                $.ajax({
                    type: 'POST',
                    data: $(this.seccon+" #data > form").serialize(),
                    url: url+"seg/"+this.table+"/save/",
                    success: function(fkey){
                        $.get(url+"seg/"+callback+"/add/"+fkey+"/", function(seg){
                            $(this.seccon).append(seg);
                        });
                        this.addFkey = fkey;
                    }
                }); 
         }
         else{
            $.get(url+"seg/"+callback+"/"+fkey, function(seg){
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
        $.get(url+"seg/"+this.table+"/edit/"+this.dbid ,function(data){
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
        $.get(url+"seg/"+this.table+"/data/"+this.db ,function(data){
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
    $(btn).click(function(){//add dialogbox and validation 
        $.get(url+"seg/"+this.table+"/delete/"+this.dbid ,function(data){
        });
        $.get(url+"seg/"+this.table+"/add/",function(data){
            $("#"+this.id).replaceWith(data);
        });   
    });
}
Btnset.prototype.save = function(){
     $(this.btncon).append("<div id=\"save\" title=\"save\"></div>");
    btn = this.btncon+" > #save";
    $(btn).button({
        icons:{
            primary: icons.save
        },
        text: false
    });
    $(btn).click(function(){
        //isgood = validator(valids);
        //if(isgood === true){
             $.ajax({
                    type: 'POST',
                    data: $(this.seccon+" #data > form").serialize(),
                    url: url+"seg/"+this.table+"/save/"+this.dbid,
                    success: function(id){
                        $.get(url+"seg/"+this.table+"/view/"+id ,function(data){
                           $(this.seccon+" #save").click()
                           $("#"+this.id).replaceWith(data);
                        });
                    }
                }); 
      //  }
        //else{
          //  $("#validate-message").text().replaceWith(isgood.message);
            //dialog box goes here
       // }
    });
}

 /*Btnset.prototype.validator = function(toCheck){
    //write this shit later 
}
   
function validator(toCheck){
    
    else{
    return true;
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
}*/