$(document).ready(function() {
    $('#registrationForm').formValidation({
        fields: {
            birthday: {
                validators: {
                    callback: {
                        message: 'La fecha de nacimiento no es válida',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }

                            // Check if the value has format of DD-MM-YYYY
                            return moment(value, 'DD/MM/YYYY', true).isValid();
                        }
                    }
                }
            }
        }
    });

    $("#inputFechaNacimiento").keyup(function(e){
        if (e.keyCode != 8){
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            } else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        } else {
            var temp = $(this).val();

            if ($(this).val().length == 5){
                $(this).val(temp.substring(0,4));
            } else if ($(this).val().length == 2){
                $(this).val(temp.substring(0,1));
            }
        }
    });
    
    if($("select[name='pais']").val()!=28){
        $("#info_spain").slideUp(); 
    }
    
    $("select[name='pais']").change(function(){
        if($(this).val()==28){//Es España
            $("#info_spain").slideDown(); 
        }else{
            $("#info_spain").slideUp(); 
        }
    });
});
