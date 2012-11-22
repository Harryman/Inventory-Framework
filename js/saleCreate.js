$(function(){
    $("#button")
    .button()
    .click(function(){
        $.ajax({
            url: urlbase+"/saleCreate/add",
            type: 'POST',
            data: $("#sku").serialize(),
            success: function(data){
                if(data=="not found"){
                    alert("sku was not found");
                }
                else{
                    $("#results").prepend(data);
                    $("#sku").val("");
                }
            }
        });
    });
    $("#sku").focus(function(){
        $("#sku").keypress(function(key){
            if(key.which == 13){
                $("#button").click();
            }
        });
    });
});
