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

Btnset.prototype.dbidset = function(set){
    this.dbid = set;
}

Btnset.prototype.add = function(callback, title, fkey){
    this.addCallback = callback;
    this.addTitle = title;
    if(fkey<100000000){
        this.addFkey = fkey;
    }
    $(this.btncon).append("<div id=\"add\"></div>");
    if(!title){
        $(this.btncon+" > #add").attr("title", "add");
    }
    else{
        $(this.btncon+" > #add").attr("title",title);
    }
    $(this.btncon+" > #add").button({
        icons:{
            primary: icons.add
        },
        text: false
    });
    $(this.btncon+" > #add").on('click',{value:this}, function(event){
        if(!event.data.value.addFkey){
            isgood = event.data.value.validator();
            if(isgood === true){
                $.ajax({
                    type: 'POST',
                    data: $(event.data.value.seccon+" #data > form").serialize(),
                    url: urlbase+"seg/"+event.data.value.table+"/save/",
                    success: function(fkey){
                        if(fkey == 0){
                            fkey = event.data.value.id;
                        }
                        $.get(urlbase+"seg/"+callback+"/add/"+fkey+"/", function(seg){
                            $(event.data.value.seccon).append(seg);
                        });
                        event.data.value.dbidset(fkey);
                    }
                }); 
            }
         }
         else{
            $.get(urlbase+"seg/"+callback+"/add/"+fkey, function(seg){
                $(event.data.value.seccon).append(seg);
            });
         }
     });
}

Btnset.prototype.edit = function(){
    $(this.btncon).append("<div id=\"edit\" title=\"edit\"></div>");
    $(this.btncon+" > #edit").button({
        icons:{
            primary: icons.edit
        },
        text: false
    });
    $(this.btncon+" > #edit").on('click',{value:this}, function(event){
        $.get(urlbase+"seg/"+event.data.value.table+"/edit/"+event.data.value.dbid ,function(data){
            $(event.data.value.seccon+" > #data").replaceWith(data);
        });
        $(event.data.value.btncon).children().remove();
        event.data.value.del();
        event.data.value.cancel();
        event.data.value.add(event.data.value.addCallback,event.data.value.addTitle,event.data.value.addFkey);
        event.data.value.save();   
    });        
}
Btnset.prototype.cancel = function(){
    $(this.btncon).append("<div id=\"cancel\" title=\"cancel\"></div>");
    $(this.btncon+" > #cancel").button({
        icons:{
            primary: icons.cancel
        },
        text: false
    });
    $(this.btncon+" > #cancel").on('click',{value:this}, function(event){
        $(event.data.value.seccon+" #cancel:not("+event.data.value.btncon+" > #cancel)").trigger('click');
        $.get(urlbase+"seg/"+event.data.value.table+"/data/"+event.data.value.dbid ,function(data){
            $(event.data.value.seccon+" > #data").replaceWith(data);
        });
    });        
}

Btnset.prototype.del = function(){
    $(this.btncon).append("<div id=\"delete\" title=\"delete\"></div>");
    $(this.btncon+" > #delete").button({
        icons:{
            primary: icons.del
        },
        text: false
    });
   $(this.btncon+" > #delete").on('click',{value:this}, function(event){//add dialogbox and validation 
        $.get(urlbase+"seg/"+event.data.value.table+"/delete/"+event.data.value.dbid ,function(data){
        });
        $(event.data.value.seccon).remove();
       // $.get(urlbase+"seg/"+event.data.value.table+"/add/",function(data){
       //     $("#"+event.data.value.id).replaceWith(data);
      //  });   
    });
}
Btnset.prototype.save = function(){
    $(this.btncon).append("<div id=\"save\" title=\"save\"></div>");
    $(this.btncon+" > #save").button({
        icons:{
            primary: icons.save
        },
        text: false
    });
    $(this.btncon+" > #save").on('click',{value:this}, function(event){
        isgood = event.data.value.validator();
        $(event.data.value.seccon+" #save:not("+event.data.value.btncon+" > #save)").trigger('click'); 
         var stu = event.data.value;
        if(isgood === true){
             $.ajax({
                type: 'POST',
                data: $(event.data.value.seccon+" > #data > form").serialize(),
                url: urlbase+"seg/"+stu.table+"/save/"+stu.dbid,
                success: function(id){
                    if(id == 0){
                       id = stu.dbid;
                    }       
                    $.get(urlbase+"seg/"+stu.table+"/view/"+id ,function(data){
                       $("#"+stu.id).replaceWith(data);
                    });
                }
            }); 
        }
   });
}

 Btnset.prototype.validator = function(){
    $this = this;
    $(this.seccon+" > #data .u-fucked-up").removeClass("u-fucked-up")
    $("#"+this.table+this.id+"validate").text("");
    if(vald[this.table]){
       $.each(vald[this.table], function(k,v){
          flag = false;
          if(v == "required"){
              isgood = $($this.seccon +" > #data #"+k).val();
              if(isgood == ""){
                  $("#"+$this.table+$this.id+"validate").append("<strong>"+k+"</strong> is required<br/>");
                  flag = true;
                  $($this.seccon +" > #data #"+k).addClass("u-fucked-up");
                }
             }
        });
        if(flag == true){
            $("#"+$this.table+$this.id+"validate").dialog({
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
    else{
        return true;
    }
}
  
Btnset.prototype.formFill = function(){
    $this = this;
    $.get(urlbase+"seg/"+$this.table+"/get/"+$this.dbid ,function(data){
        $.each(data, function(k,v){
            $($this.seccon+" > #data  #"+k).val(v);
        });
    });
}

Btnset.prototype.dataFill = function(title){
    var $this = this;
    $.get(urlbase+"seg/"+$this.table+"/get/"+$this.dbid+"",function(data){
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

  
  

function inhrt(o){
    function F(){};
    F.prototype = o;
    return new F();
}