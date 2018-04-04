var appendedStripeToken = false;
var $form = $('#payment-form');

var stripeResponseHandler = function(status, response) {
    if (response.error) {
        $form.find('.payment-errors p').text(response.error.message);
        $form.find('button').prop('disabled', false);
    } else {
        var token = response.id;
        handleCall(token);
    }
};

function handleCall(token) { 
    if (!appendedStripeToken) { 
        $form.append($('<input type="hidden" name="stripeToken">').val(token));
        appendedStripeToken = true; 
        $form.get(0).submit();
    } 
}

$(document).ready(function() {
    $("input[name=pay_method]").on("change", function() {
        var method = $(this).val();
        $(".pay_method_inputs").slideUp();
        $(".pay_method_inputs input").attr("disabled","disabled");
        $("#"+method+"_inputs").slideDown();
        $("#"+method+"_inputs input").removeAttr("disabled");
    } );

    $form.submit(function(event) {
        $('button[type=submit], input[type=submit]').prop('disabled',true);
        if($("input[name=pay_method]:checked").val()=="stripe"){
            Stripe.setPublishableKey($("#stripe_inputs").data("publickey"));
            Stripe.card.createToken($form, stripeResponseHandler);
            event.preventDefault();
        }
    });
});