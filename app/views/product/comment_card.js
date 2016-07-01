$(".new-comment-edit").keyup(function(e){
     var code = e.keyCode || e.which;
     if(code == 13 && ($(this).text().replace(/\s+/g, '').trim())!="") { //publicamos el texto del comentario
        if(typeof $(this).parent() == 'undefined'){
            var parent=$(this).parent()
        }else{
            var parent=undefined;
        }
        var parametros={
            "producto": $(".product_file").data("id"),
            "comentario": $(this).text().trim(),
            "parent": parent
        };

        $.ajax({
            data:parametros,
            url: '?action=comment',
            type: 'POST',
            success: function (response){
                $(".new-comment-edit").html("");
                $("#comments_list").prepend(response);
            },
            error: function (){
                alert('Error al comentar');
            }
        });
     }
});
