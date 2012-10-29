function Btnset(idr,tabler,container){
    this.id = idr;
    this.dbid;
    if(this.id < 100000000){
        this.dbid = this.id;
    }
    this.table = tabler;
    this.container = container;
    this.btncon = "#"+this.id+" > #"+tabler+" > #data "+container+" > .buttons";
    this.hedcon = "#"+this.id+" > #"+tabler+" > #data "+container;
    this.seccon = "#"+this.id+" > #"+tabler;
    $(this.btncon).buttonset();
}

Btnset.prototype.add = function(callback, title, fkey){
    this.addCallback = callback;
    this.addTitle = title;
    if(fkey<100000000){
        this.addFkey = fkey;
    }
    $this = this;
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
         if(!$this.addFkey){
                $.ajax({
                    type: 'POST',
                    data: $($this.seccon+" #data > form").serialize(),
                    url: urlbase+"seg/"+$this.table+"/save/",
                    success: function(fkey){
                        $.get(urlbase+"seg/"+callback+"/add/"+fkey+"/", function(seg){
                            $($this.seccon).append(seg);
                        });
                        $this.addFkey = fkey;
                    }
                }); 
         }
         else{
            $.get(urlbase+"seg/"+callback+"/"+fkey, function(seg){
                $($this.seccon).append(seg);
            });
         }
     });
     this.addFkey = $this.addFkey;
}

Btnset.prototype.edit = function(){
    $(this.btncon).append("<div id=\"edit\" title=\"edit\"></div>");
    $this = this;
    btn = this.btncon+" > #edit";
    $(btn).button({
        icons:{
            primary: icons.edit
        },
        text: false
    });
    $(btn).click(function(){
        $.get(urlbase+"seg/"+$this.table+"/edit/"+$this.dbid ,function(data){
            $($this.seccon+" > #data").replaceWith(data);
        });
        $($this.btncon).children().remove();
        $this.del();
        $this.cancel();
        $this.add($this.addCallback,$this.addTitle,$this.addFkey);
        $this.save();   
    });        
}
Btnset.prototype.cancel = function(){
    $(this.btncon).append("<div id=\"cancel\" title=\"cancel\"></div>");
    btn = this.btncon+" > #cancel";
    $this = this;
    $(btn).button({
        icons:{
            primary: icons.cancel
        },
        text: false
    });
    $(btn).click(function(){
        $.get(urlbase+"seg/"+$this.table+"/data/"+$this.dbid ,function(data){
            $($this.seccon+" > #data").replaceWith(data);
        });
    });        
}

Btnset.prototype.del = function(){
    $(this.btncon).append("<div id=\"delete\" title=\"delete\"></div>");
    btn = this.btncon+" > #delete";
    $this = this;
    $(btn).button({
        icons:{
            primary: icons.del
        },
        text: false
    });
    $(btn).click(function(){//add dialogbox and validation 
        $.get(urlbase+"seg/"+$this.table+"/delete/"+$this.dbid ,function(data){
        });
        $.get(urlbase+"seg/"+$this.table+"/add/",function(data){
            $("#"+$this.id).replaceWith(data);
        });   
    });
}
Btnset.prototype.save = function(){
     $(this.btncon).append("<div id=\"save\" title=\"save\"></div>");
    $this = this;
    btn = this.btncon+" > #save";
    $(btn).button({
        icons:{
            primary: icons.save
        },
        text: false
    });
    $(btn).click(function(){
        isgood = $this.validator();
        if(isgood === true){
             $.ajax({
                    type: 'POST',
                    data: $($this.seccon+" #data > form").serialize(),
                    url: urlbase+"seg/"+$this.table+"/save/"+$this.dbid,
                    success: function(id){
                        if(id == 0){
                            id = $this.dbid;
                        }
                        $.get(urlbase+"seg/"+$this.table+"/view/"+id ,function(data){
                           $($this.seccon+" #save:not("+btn+")").click();
                           $("#"+$this.id).replaceWith(data);
                        });
                    }
                }); 
        }
   });
}

 Btnset.prototype.validator = function(){
     $this = this;
     $("#validate-msg").text("");
    $.each(vald[this.table], function(k,v){
        flag = false;
        if(v == "required"){
            isgood = $($this.seccon +" > #data #"+k).val();
            if(isgood == ""){
                $("#validate-msg").append("<strong>"+k+"</strong> is required<br/>");
                flag = true;
            }
        }
    });
    if(flag == true){
        $("#validate-msg").dialog({
             modal: true,
             buttons:{
                 Ok: function(){
                     $(this).dialog("close");
                 }
             }
         });
         return false;
    }
    else{
        return true;
    }
}

Btnset.prototype.formFill = function(){
    $this = this;
    $.get(urlbase+"seg/"+this.table+"/get/"+this.dbid ,function(data){
        $.each(data, function(k,v){
            $($this.seccon+" > #data  #"+k).val(v);
        });
    });
}

Btnset.prototype.dataFill = function(title){
    $this = this;
    $.get(urlbase+"seg/"+this.table+"/get/"+this.dbid ,function(data){
        $.each(data, function(k,v){
            if(k == title){
                $($this.hedcon).prepend(v); 
            }
            else{
                $($this.seccon+" > #data #"+k).text(v);
            }
        });
    });
}    

  
 /*  
function validator(toCheck){
    
    else{
    return true;
    }
}
function inhrt(o){
    function F(){};
    F.prototype = o;
    return new F();
}*/