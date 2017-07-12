$(function() {

    $('#login-form-link').click(function(e) {
        $("#register-form").fadeOut(100);
        $("#login-form").delay(100).fadeIn(100);
       $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

});
