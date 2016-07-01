$(document).ready(function() {
    $(".validar").click(function(e){
        e.preventDefault();
        var selected=$(this);
        var parametros = {
            id: $(this).closest(".producto").data("id")
        }

        $.ajax({
            method: "POST",
            url: selected.attr("href"),
            data:parametros,
            success: function(response){
                if(response==1){
                    selected.closest(".producto").addClass("success");
                }else{
                    alert(response);
                }
            },
            error: function(){
                alert("error ajax");
            }
        })
    });

    $(".denegar").click(function(e){
        e.preventDefault();
        var selected=$(this);
        $(".modal-header").html("Añade una nota para el creador");
        $(".modal-body").html("<form><textarea id='denegar_nota' class='form-control'></textarea></form>");
        $(".modal-footer").html("<button id='denegar_btn' type='button' class='btn btn-primary'>Enviar</button>");
        $(".modal").modal();
        $("body").on("click", "#denegar_btn", function(){
            var parametros = {
                id: selected.closest(".producto").data("id"),
                nota: $("#denegar_nota").val()
            }

            $.ajax({
                method: "POST",
                url: selected.attr("href"),
                data:parametros,
                success: function(response){
                    if(response==1){
                        $(".modal").modal("hide");
                        selected.closest(".producto").remove();
                    }else{
                        alert(response);
                    }
                },
                error: function(){
                    alert("error ajax");
                }
            })
        });
    });

    $('.colorpicker-input').colorpicker();

    $("form").formValidation();

    $('.uploads').DataTable({
        "responsive": true,
        "order": [[ 0, "desc" ]]
    });
});

