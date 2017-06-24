$(document).ready(function() {

    $("#main-contact-form").submit(function(event) {
        event.preventDefault();
        grecaptcha.execute();
    });
});

function onSubmit(response) {
    var request;

    if (request) {
        request.abort();
    }

    var $form = $('#main-contact-form');
    var form_status = $('<div class="form_status"></div>');
    var $inputs = $form.find("input, select, button, textarea");

    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "form.php",
        type: "POST",
        data: serializedData,
        beforeSend: function() {
            $form.prepend(form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn());
        }
    });

    request.done(function(response, textStatus, jqXHR) {
        isSuccess = true;
        form_status.html('<p class="text-success">Thank you for contacting us. We will get back to you shortly.</p>');
        $form.find("input[type=text],input[type=email],textarea").val("");
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        form_status.html('<p class="text-error">Could not send mail now. Please try again later.</p>').delay(5000).fadeOut();
        $inputs.prop("disabled", false);
    });
}
