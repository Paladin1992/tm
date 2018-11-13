"use strict";

const ERROR_LOAD_VIDEOS = 'Hiba történt a videók betöltésekor. Frissítse az oldalt, és próbálja újra.';
const ERROR_LOAD_CAPTCHA = 'Az új captcha betöltése sikertelen.';

var menuButton;

$(document).ready(function() {

    menuButton = $('#btn-menu');
    menuButton.on('click', function() {
        if ($('.navbar-collapse.collapse').hasClass('in')) { // open -> close
            menuButton.removeClass('opened');
        } else { // closed -> open
            menuButton.addClass('opened');
        }
    });

    $('form input, form textarea').on('input', function() {
        var emptyFields = $('form').serializeArray().filter(function(item) {
            return /^\s*$/.test(item.value);
        });

        $('#btn-send-email').prop('disabled', emptyFields.length > 0);
    });
});

function loadVideos(page, destinationId) {
    $.get('loadvideos.php?p=' + page, function(response, status) {
        var result = (status === 'success' ? response : ERROR_LOAD_VIDEOS);
        $('#' + destinationId).html(result);
    });
}

function load() {
    loadVideos('hatasok', 'additional-videos');
    $('#btn-load-videos').slideUp(500);
}

function sendEmail() {
    try {
        // get form data
        var form = $('form[name="form-email"]');
        var data = form.serializeArray();
        form.find('fieldset').prop('disabled', true);

        // post data to server to send as an e-mail
        $.post('sendemail.php', data, function(response, status) {
            var result = JSON.parse(response);

            if (result.status === 'success') {
                $('.mail-response')
                    .html(result.message)
                    .removeClass('alert-success alert-error')
                    .addClass('alert-success')
                    .show()
                    .delay(8000)
                    .slideUp(500);
            } else {
                $('.mail-response')
                    .html(result.message)
                    .removeClass('alert-success alert-error')
                    .addClass('alert-error')
                    .show()
                    .delay(8000)
                    .slideUp(500);
            }

            form.find('fieldset').prop('disabled', false);
        });
    } catch (ex) {
        throw new Error(ex.message);
    }    
}

function showContact(card) {
    //return false; // may be used for trial period
    
    var card = $(card);
    card.addClass('open');
    card.siblings('.form-container').slideDown(500);

    var offsetTop = card.offset().top;
    $('html, body').animate({
        scrollTop: offsetTop
    }, 800);
}

function refreshCaptcha(destinationElement) {
    $.get('captcha.php', function(response, status) {
        var tempObj = JSON.parse(response);
        var result = (status === 'success' ? response : ERROR_LOAD_CAPTCHA);
        //var result = (status === 'success' ? tempObj.image : ERROR_LOAD_CAPTCHA);
        $(destinationElement).attr('src', result);

        //$('#captcha-code').html(tempObj.code);
    });
}