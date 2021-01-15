//toggling the login form
$(document).ready(function () {
    $("#hideLogin").click(function () {
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#hideRegister").click(function () {
        $("#loginForm").show();
        $("#registerForm").hide();
    });
});


//hiding comment and reply form
jQuery(document).ready(function () {
    $('#arrow_img').click(function () {
        $('div.hideform').toggle('slow');
    });

    //hiding the reply form
    $('.replies').click(function () {
        $(this).prev('form.replyForm').toggle('slow');
        $(this).next('form.replyForm').toggle('slow');
        // return true;

    });

    //hiding the comment form
    $('div#toggleComments').click(function () {
        $('form#commentForm').toggle('slow');
    });
});

jQuery(document).ready(function () {
    $('#show_login').addClass('active').css('background-color', '#479fc6');
    $('#show_registrationform').click(function () {
        $('#show_registrationform').addClass('active').css('background-color', '#479fc6');
        $('#show_login').removeClass('active').css('background-color', '#E2E6EA');
        $('#loginForm').hide('slow');
        $('#registerForm').show('slow');
    });

    $('#show_login').click(function () {
        $('#show_login').addClass('active').css('background-color', '#479fc6');
        $('#show_registrationform').removeClass('active').css('background-color', '#E2E6EA');
        $('#loginForm').show('slow');
        $('#registerForm').hide('slow');
    });
});