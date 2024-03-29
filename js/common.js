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
            isgood = validator(event.data.value.id,true);
            if(isgood === true){
                $.ajax({
                    type: 'POST',
                    data: $(event.data.value.seccon+" > #data > div > *").serialize(),
                    url: urlbase+"seg/"+event.data.value.table+"/save/"+event.data.value.dbid,
                    success: function(fkey){
                        if(fkey == 0){
                            fkey = event.data.value.dbid;
                        }
                        $.get(urlbase+"seg/"+callback+"/add/"+fkey+"/", function(seg){
                            $(event.data.value.seccon+" > #data").after(seg);
                            $(event.data.value.seccon+" > #data").next().hide();
                            $(event.data.value.seccon+" > #data").next().slideDown(function(){
                            });
                        });
                        event.data.value.dbidset(fkey);
                    }
                }); 
            }
         }
         else{
            $.get(urlbase+"seg/"+callback+"/add/"+fkey, function(seg){
                $(event.data.value.seccon+" > #data").after(seg);
                $(event.data.value.seccon+" > #data").next().hide();
                $(event.data.value.seccon+" > #data").next().slideDown(function(){
                });
            });
         }
     });
}

Btnset.prototype.edit = function(noProp){
    $(this.btncon).append("<div id=\"edit\" title=\"edit\"></div>");
    $(this.btncon+" > #edit").button({
        icons:{
            primary: icons.edit
        },
        text: false
    });
    $(this.btncon+" > #edit").on('click',{value:this}, function(event){
        if(event.hasOwnProperty('originalEvent')){
             if(noProp == undefined){
                $(event.data.value.seccon+" #edit:not("+event.data.value.btncon+" > #edit)").trigger('click'); 
             }
        }
        var stu = event.data.value;
        $.get(urlbase+"seg/"+stu.table+"/edit/"+stu.dbid ,function(data){
            $(stu.seccon+" > #data").slideUp("fast",function(){
                $(stu.seccon+" > #data").replaceWith(data);
                $(stu.seccon+" > #data").hide();
                    $(stu.seccon+" > #data").slideDown(function(){
                });
            });
        });
    });        
}
Btnset.prototype.editSeg = function(){
    $("#"+this.id+" > #"+this.table+this.container+" > .buttons").append("<div id=\"editSeg\" title=\"edit\"></div>");
    $("#"+this.id+" > #"+this.table+this.container+" > .buttons > #editSeg").button({
        icons:{
            primary: icons.edit
        },
        text: false
    });
    
    $("#"+this.id+" > #"+this.table+this.container+" > .buttons > #editSeg").on('click',{value:this}, function(event){
        var stu = event.data.value;
            $(stu.seccon).after(function(){
                $(this).load(urlbase+"seg/"+stu.table+"/edit/"+stu.dbid ,function(){
            });
        });
    });        
}
Btnset.prototype.cancel = function(noProp){
    $(this.btncon).append("<div id=\"cancel\" title=\"cancel\"></div>");
    $(this.btncon+" > #cancel").button({
        icons:{
            primary: icons.cancel
        },
        text: false
    });
    $(this.btncon+" > #cancel").on('click',{value:this}, function(event){
        if(event.hasOwnProperty('originalEvent')){
            if(noProp == undefined){
                $(event.data.value.seccon+" #cancel:not("+event.data.value.btncon+" > #cancel)").trigger('click');
            }
        }
        var stu = event.data.value;
        $.get(urlbase+"seg/"+stu.table+"/data/"+stu.dbid ,function(data){
            $(stu.seccon+" > #data").slideUp("fast",function(){
                $(stu.seccon+" > #data").replaceWith(data);
                $(stu.seccon+" > #data").hide();
                    $(stu.seccon+" > #data").slideDown(function(){
                });
            });
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
            $("#"+event.data.value.id).slideUp(function(){
                $(this).remove();
            });
        });
       // $.get(urlbase+"seg/"+event.data.value.table+"/add/",function(data){
       //     $("#"+event.data.value.id).replaceWith(data);
      //  });   
    });
}
Btnset.prototype.save = function(noProp){
    $(this.btncon).append("<div id=\"save\" title=\"save\"></div>");
    $(this.btncon+" > #save").button({
        icons:{
            primary: icons.save
        },
        text: false
    });
    $(this.btncon+" > #save").on('click',{value:this}, function(event){
        var go = true
        if(event.hasOwnProperty('originalEvent')){
            isgood = validator(event.data.value.id,noProp);  
            if(isgood == true){
                if(noProp == undefined){
                    $(event.data.value.seccon+" #save:not("+event.data.value.btncon+" > #save)").trigger('click');
                }
            }
            else{
                go = false
            }
            var isPar = true;
        }
        var stu = event.data.value;      
        if(go == true){
            if(stu.dbid == undefined){
              idval = $(stu.seccon+" > #data > div > input#id").val();
              if(idval != ""){
                  stu.dbid = idval;
              }
            }
            $.ajax({
                type: 'POST',
                data: $(stu.seccon+" > #data > div > *").serialize(),
                url: urlbase+"seg/"+stu.table+"/save/"+stu.dbid,
                success: function(id){
                    if(id == 0){
                       id = stu.dbid;
                    }       
                    if(isPar == true){
                        if(noProp == undefined){
                            $("#"+stu.id).slideUp("fast",function(){    
                                $.get(urlbase+"seg/"+stu.table+"/view/"+id ,function(data){
                                    $("#"+stu.id).replaceWith(data);
                                    $("#"+stu.id).hide();
                                    $("#"+stu.id).slideDown(function(){
                                    });
                                });
                            });
                        }
                        else{
                            $.get(urlbase+"seg/"+stu.table+"/data/"+stu.dbid ,function(data){
                                $(stu.seccon+" > #data").slideUp("fast",function(){
                                    $(stu.seccon+" > #data").replaceWith(data);
                                    $(stu.seccon+" > #data").hide();
                                    $(stu.seccon+" > #data").slideDown(function(){
                                    });
                                });
                            });
                        }
                    }
                }
            }); 
        }
   });
}
Btnset.prototype.formFill = function(){
    var $this = this;
    $.get(urlbase+"seg/"+$this.table+"/get/"+$this.dbid ,function(data){
        $.each(data, function(k,v){
            $($this.seccon+" > #data > * #"+k).val(v);
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
                $($this.seccon+" > #data > * #"+k).text(v);
            }
        });
    });
}



function Fbtn(table, f_id, id, selector){
    this.f_id = f_id;
    this.id = id;
    this.table = table;
    if(selector != undefined){
        this.selector = selector;
    }
    else{
        this.selector = "#"+this.f_id+" > #"+this.table+" > #data";
    }
    $(this.selector+" #"+this.id+" .buttons").buttonset();
}
Fbtn.prototype.del = function(){
    $(this.selector+" #"+this.id+" > .buttons").append("<button id='del'></button>");
    $(this.selector+" #"+this.id+" > .buttons #del")
        .button({
            icons:{
                    primary: icons.del
                },
            text: false
        })
    .on('click',{value:this},function(event){
        var stu = event.data.value;
        $.ajax({
            type:'POST',
            url: urlbase+"/seg/"+stu.table+"/delete",
            data: "id="+stu.id,
            success: function(){
                 $(stu.selector+" #"+stu.id)
                    .slideUp(function(){
                    $(this).remove();
                    })
            }
        });
    });
}
Fbtn.prototype.cancel = function(){
    $(this.selector+" #"+this.id+" > .buttons").append("<button id='cancel'></button>");
    $(this.selector+" #"+this.id+" > .buttons #cancel")
        .button({
            icons:{
                primary: icons.cancel
                },
            text: false
        })
        .on('click',{value:this},function(event){
            window[event.data.value.table].cancel(event.data.value.id,event.data.value.f_id);
        });
}
Fbtn.prototype.save = function(){
    $(this.selector+" #"+this.id+" > .buttons").append("<button id='save' title='save'></button>");
    $(this.selector+" #"+this.id+" > .buttons #save")
        .button({
            icons:{
                    primary: icons.save
                },
            text: false
        })
        .on('click',{value:this},function(event){
            var stu = event.data.value;
            if(validator(event.data.value.id)){
                $.ajax({
                    type:'POST',
                    url: urlbase+"/seg/"+stu.table+"/insert",
                    data:  $(stu.selector+" #"+stu.id+" > *, "+stu.selector+" #"+stu.id+" > * > *").serialize(),
                    success: function(actid){
                        window[stu.table].save(actid,stu.f_id);   
                    }
                });
            }
    });
}
Fbtn.prototype.edit = function(){
    $(this.selector+" > * > .buttons:empty").append("<button style='display:none' id='edit'></button>");
    $(this.selector+" > * > .buttons #edit")
        .button({
            icons:{
                    primary: icons.edit
                },
            text: false
        })
        .on('click',{value:this},function(event){
            var stu = event.data.value;
            id = $(this).parent().parent().attr('id');
            window[stu.table].edit(id,stu.f_id);

        });
    $(this.selector+" > div").on('mouseenter',function(){
        $(this).find("#edit").show();
    })
    $(this.selector+" > div").on('mouseleave',function(){
        $(this).find("#edit").hide();
    })
}
    
function validator(parent,noprop,isBase){
    flag = false;
    $("#validate").empty();
    $(".u-fucked-up").removeClass("u-fucked-up");
    $.each(vald,function(t){
        $.each(vald[t],function(k,v){
                if($("#"+parent+" #"+t+" #"+k).length){
                    if(noprop == true){
                        var top = "#"+parent+" > #"+t;
                    }
                    else{
                        var top = "#"+parent+" #"+t;
                    }
                    if(v == "required"){
                        $(top+" > #data > div *#"+k).each(function(p){
                            var val =  $(this).val();
                            if(val == ""){
                                $("#validate").append("<strong>"+k+"</strong> is required<br/>");
                                flag = true;
                                $(this).addClass("u-fucked-up");
                            }
                        });
                    }
                    if(v == "unique"){
                         $(top+" > #data > div *#"+k).val();
                         $.get(urlbase+"/seg/product/unique/"+noprop+"/"+k+"/"+val, function(data){
                             if(data > 0){
                                $("#validate").append("<strong>"+k+"</strong> Must Be Unique<br/>");
                                flag = true;
                                $(top+" > #data > div *#"+k).addClass("u-fucked-up");
                             }
                         });
                    }
                 }
                 else if(isBase == true){
                     if(v == "required"){
                        var val = $("#"+parent+" > *#"+k+", #"+parent+" > * > *#"+k).val();
                        if(val == ""){
                            $("#validate").append("<strong>"+k+"</strong> is required<br/>");
                            flag = true;
                            $(this).addClass("u-fucked-up");
                        }
                    }
                    if(v == "unique"){
                         var val = $("#"+parent+" > *#"+k+", #"+parent+" > * > *#"+k).val();
                         $.get(urlbase+"/seg/product/unique/"+noprop+"/"+k+"/"+val, function(data){
                             if(data > 0){
                                $("#validate").append("<strong>"+k+"</strong> Must Be Unique<br/>");
                                flag = true;
                                $("#"+parent+" > *#"+k+", #"+parent+" > * > *#"+k).addClass("u-fucked-up");
                            }
                         });
                    }
                 }
            });
    });
    if(flag == true){
        $("#validate").dialog({
            modal: true,
            buttons:{
                Ok: function(){
                    $(this).dialog("close");
                }
            }
        });
    return false
    }
    else{
        return true;
    }
}  

function menuInput(selector, callback, init, name){
    $.get(urlbase+callback+init,function(json){
        if(!$.isEmptyObject(json)){
            if(name!=undefined){
               $(selector).append("<ul id='"+name+"'></ul>");
            }
            else{
                $(selector).append("<ul></ul>");
            }
        }
        else{
            $(selector).attr('title','bottom level');
        }
         $.each(json,function(i,n){
            $(selector+" > ul").append("<li id='"+n.id+"'><a>"+n.name+"</a></li>");
            out = selector+" > ul > li#"+n.id;
            menuInput(out,callback,n.id);
         });
    });
}

function prodAC(){
    $(function(){
        $(".prodac").autocomplete({
            source: urlbase+"seg/product/ac"
        });
    });
}
function editView(table,json,p_id){
    var hl = "";
    $.ajax({
        url: urlbase+"html/seg/"+table+"/editView.html",
        async: false,
        success: function(ht){
            $.each(json, function(n){
                hm = $("<div />").html(ht).find("div:first").attr('id',json[n].id).end().html();
                $.each(json[n], function(i,d){
                    hm = $("<div />").html(hm).find("#"+i).text(d).end().html();
                    hm = $("<div />").html(hm).find("#"+i).attr('value',d).end().html();
                    if(d == 1){
                        hm = $("<div />").html(hm).find("#"+i+"[type='checkbox']").prop('checked',true).end().html();
                    }
                });
                hl += hm;
            });
        }
    });
    return hl;
}
function dataView(tableView,json){
    var hl = "";
    $.ajax({
        url: urlbase+"html/seg/"+tableView,
        async: false,
        success: function(ht){
            if($.isEmptyObject(json)){
                return "There were no results.";
            }
            if(ht == undefined){
                return "Specified view does not exsist.";
            }
            $.each(json, function(n){
                hm = $("<div />").html(ht).find("div:first").attr('id',json[n].id).end().html();
                $.each(json[n], function(i,d){
                    hm = $("<div />").html(hm).find("#"+i).append(d).end().html();
                });
                hl += hm;
            });
        }
    });
            return hl;
}
function inhrt(o){
    function F(){};
    F.prototype = o;
    return new F();
}