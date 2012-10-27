function Btnset(idr,tabler,container){
    this.id = idr;
    this.dbid;
    if(this.id < 100000000){
        this.dbid = this.id;
    }
    this.table = tabler;
    this.container = container;
    this.btncon = "#"+this.id+" > #"+tabler+" > "+container;
    this.seccon = "#"+this.id+" > #"+tabler;
    $(this.btncon).buttonset();
}

Btnset.prototype.add = function(callback, title, fkey){
    this.addCallback = callback;
    this.addTitle = title;
    this.addFkey = fkey;
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
        $this.submit();   
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
        $.get(urlbase+"seg/"+$this.table+"/data/"+$this.db ,function(data){
            $($this.seccon+" > #data").replaceWith(data);
        });
        $($this.btncon).children().remove();
        $this.edit();
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
        //isgood = validator(valids);
        //if(isgood === true){
             $.ajax({
                    type: 'POST',
                    data: $($this.seccon+" #data > form").serialize(),
                    url: urlbase+"seg/"+$this.table+"/save/"+$this.dbid,
                    success: function(id){
                        $.get(urlbase+"seg/"+$this.table+"/view/"+id ,function(data){
                           $($this.seccon+" #save").click()
                           $("#"+$this.id).replaceWith(data);
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
}*/