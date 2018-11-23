"use strict";

const ALERT_SHOW_DELAY_MS = 8000;
const ALERT_FADE_OUT_MS = 500;
const ERROR_LOAD_VIDEOS = 'Hiba történt a videók betöltésekor. Frissítse az oldalt, és próbálja újra.';
const ERROR_LOAD_CAPTCHA = 'Az új captcha betöltése sikertelen.';

var menuButton;

$(document).ready(function() {

    // menu
    menuButton = $('#btn-menu');
    menuButton.on('click', function() {
        if ($('.navbar-collapse.collapse').hasClass('in')) { // open -> close
            menuButton.removeClass('opened');
        } else { // closed -> open
            menuButton.addClass('opened');
        }
    });

    // blockquote show toggle
    $('.quot-show-toggle a').on('click', function() {
        var container = $('blockquote.short');

        if (container.hasClass('open')) { // close
            container.removeClass('open')
                     .animate({ height: '200px' }, 1000, () => {
                        scrollToItem(container); // kell?
                     });

            $(this).html('Tovább olvasom &raquo;');
        } else { // open
            container.addClass('open')
                     .animate({ height: container.get(0).scrollHeight }, 1000, () => {
                        scrollToItem(container);
                     });

            $(this).html('&laquo; Kis méret');
        }
    });

    // contact form
    $('form input, form textarea').on('input', checkSendButtonConditions);

    // GDPR checkbox
    $('.gdpr-fake-checkbox').on('click', function(e) {
        var checkbox = $('.gdpr-real-checkbox');

        if (checkbox.prop('checked')) {
            $(this).html('check_box_outline_blank');
            checkbox.prop('checked', false);
        } else {
            $(this).html('check_box');
            checkbox.prop('checked', true);
        }

        checkSendButtonConditions();
    });

    // captcha
    refreshCaptcha();

    // set Bootstrap tooltips to manual
    $('[data-toggle="tooltip"]').tooltip({ trigger: 'manual', animation: true })

    $('input.captcha-text').on('input', function() {
        var userInput = $(this).val();

        if (/\D/.test(userInput)) { // input contains a non-digit character
            $('[data-toggle="tooltip"]').tooltip('show');
        } else {
            $('[data-toggle="tooltip"]').tooltip('hide');
        }
    });
});

function scrollToItem($item) {
    $('html, body').animate({
        scrollTop: $item.offset().top
    }, 800);
}

function checkSendButtonConditions() {
    var emptyFields = $('form').serializeArray().filter(function(item) {
        return /^\s*$/.test(item.value);
    });
    var gdprRulesChecked = $('.gdpr-real-checkbox').prop('checked');

    $('#btn-send-email').prop('disabled', emptyFields.length > 0 || !gdprRulesChecked);
}

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

// type: success | error
// TODO
function showMessage(message, type) {
    var alertBox = $('.mail-response');

    if (alertBox.is(':visible')) {
        alertBox.finish();
    }

    if (type === 'success') {
        alertBox.html(message)
                .removeClass('alert-success alert-error')
                .addClass('alert-success')
                .show()
                .delay(ALERT_SHOW_DELAY_MS)
                .fadeOut(ALERT_FADE_OUT_MS);
    } else if (type === 'error') {
        alertBox.html(message)
                .removeClass('alert-success alert-error')
                .addClass('alert-error')
                .show()
                .delay(ALERT_SHOW_DELAY_MS)
                .fadeOut(ALERT_FADE_OUT_MS);
    }
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
            showMessage(result.message, result.status);
            form.find('fieldset').prop('disabled', false);
        });
    } catch (ex) {
        throw new Error(ex.message);
    }    
}

function showContact(card) {
    //return false; // may be used for trial period
    
    // hide arrow
    $('.contact-arrow-container').slideUp(500);

    var card = $(card);

    var showForm = function showForm() {
        // show form
        card.siblings('.form-container').slideDown(500);

        // scroll to card top
        scrollToItem(card);
    };

    card.addClass('open');
    if (card.outerWidth() !== $('main').width()) { // width is not 100%
        card.animate({ width: '100%' }, 500, showForm);
    } else {
        showForm();
    }
}

function refreshCaptcha() {
    $.get({
        url: 'getcaptcha.php',
        cache: false
    }, function(response, status) {
        if (status === 'success') {
            var data = JSON.parse(response);
            $('.captcha-img').attr('src', data.image);
            $('.captcha-hash').val(data.hash);
        } else {
            showMessage(ERROR_LOAD_CAPTCHA, 'error');
        }
    });
}