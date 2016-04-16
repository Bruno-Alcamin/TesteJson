
$(function(){
    $('#form-mgs').submit(function(){    
    $.ajax({
        type: 'POST',
        cache: false,
        dataType: "json",
        url: 'https://wsphp-bruno-alcamin.c9users.io/insert',
        data:{
            nome: $('input[name="nome"]').val()    
        }
    }).done(function(e){
        var itens = "";
        itens+="<tr><td>";
        itens+=e.cd_User;
        itens+="</td><td>";
        itens+=e.nm_Usuario;
        itens+="</td></tr>";
        $("#t1 tbody").append(itens);
    });
    $('input[name="nome"]').val(" ");
    return false;
    });
});

function listar(){
     var itens = "";
    $.ajax({
        type: 'GET',
        cache: false,
        dataType: "json",
        url: 'https://wsphp-bruno-alcamin.c9users.io/listar',
        beforeSend: function() {
            $("h2").html("Carregando....");
        },
        error: function() {
            $("h2").html("ERRO!");
        },
    }).done(function(e){
         for(var i = 0; i<e.length; i++){
                itens+="<tr><td>";
                itens+=e[i].cd_User;
                itens+="</td><td>";
                itens+=e[i].nm_Usuario;
                itens+="</td></tr>";
            }
            $("#t1 tbody").html(itens);
            $("h2").html("");
    });
}
