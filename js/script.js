"use strict";

const ALERT_SHOW_DELAY_MS = 8000;
const ALERT_FADE_OUT_MS = 500;
const QUOT_READ_MORE_TOGGLE_MS = 1000;
const SCROLL_SPEED_MS = 800;
const SLIDE_SPEED_MS = 500;
const CAPTCHA_MIN_SCALE = 0.762;
const CAPTCHA_ERROR_LOAD = 'Az új captcha betöltése sikertelen.';

var $captchaContainer = $('.g-recaptcha');

$(document).ready(function() {
    // menu
    $('#btn-menu').on('click', function() {
        if ($('.navbar-collapse.collapse').hasClass('in')) { // open -> close
            $(this).removeClass('opened');
        } else { // closed -> open
            $(this).addClass('opened');
        }
    });

    // blockquote show toggle
    $('.quot-show-toggle a').on('click', function() {
        var $container = $('blockquote.short');

        if ($container.hasClass('open')) { // close
            $container.removeClass('open')
                      .animate({ height: '200px' }, QUOT_READ_MORE_TOGGLE_MS, () => {
                         scrollToItem($container);
                      });

            $(this).html('Tovább olvasom &raquo;');
        } else { // open
            $container.addClass('open')
                      .animate({ height: $container.get(0).scrollHeight }, QUOT_READ_MORE_TOGGLE_MS, () => {
                         scrollToItem($container);
                      });

            $(this).html('&laquo; Kis méret');
        }
    });

    // contact form
    $('form input, form textarea').on('input', checkSendButtonConditions);

    // GDPR checkbox
    $('.gdpr-fake-checkbox').on('click', function(e) {
        var $checkbox = $('.gdpr-real-checkbox');

        if ($checkbox.prop('checked')) {
            $(this).html('check_box_outline_blank');
            $checkbox.prop('checked', false);
        } else {
            $(this).html('check_box');
            $checkbox.prop('checked', true);
        }

        checkSendButtonConditions();
    });

    if ($captchaContainer.length > 0) {
        $(window).on('resize', function() {
            resizeCaptcha();
        });
    }

    resizeCaptcha();

    // captcha
    //refreshCaptcha();

    // set Bootstrap tooltips to manual
    //$('[data-toggle="tooltip"]').tooltip({ trigger: 'manual', animation: true })

    // $('input.captcha-text').on('input', function() {
    //     var userInput = $(this).val();
    //     var action = /\D/.test(userInput) ? 'show' : 'hide';
    //     $('[data-toggle="tooltip"]').tooltip(action);
    // });
});

function scrollToItem($item) {
    $('html, body').animate({
        scrollTop: $item.offset().top
    }, SCROLL_SPEED_MS);
}

function checkSendButtonConditions() {
    var emptyFields = $('form').serializeArray().filter(function(item) {
        return /^\s*$/.test(item.value);
    });
    var captchaResponse = grecaptcha.getResponse();
    var gdprRulesChecked = $('.gdpr-real-checkbox').prop('checked');

    $('#btn-send-email').prop('disabled',
        emptyFields.length > 0 // empty input field is found
        || !captchaResponse // OR captcha failed
        || !gdprRulesChecked); // OR GDPR-checkbox is not checked
}

function getVideo(url, button) {
    var $button = $(button);
    var $videoContainer = $button.next('.video-container');
    var $iframe = $videoContainer.find('iframe');

    if ($iframe.attr('src') === '') { // no video has been loaded yet
        $iframe.attr('src', url + '?rel=0');
    }

    // hide button
    $button.slideUp(SLIDE_SPEED_MS);

    // show video
    $videoContainer.slideDown(SLIDE_SPEED_MS, function() {
        scrollToItem($videoContainer);
    });
}

function closeVideo(closeButton) {
    var $closeButton = $(closeButton);
    var $videoContainer = $closeButton.parents('.video-container');
    var $button = $videoContainer.prev('.video-button');

    // hide video
    $videoContainer.slideUp(SLIDE_SPEED_MS);

    // show button
    $button.slideDown(SLIDE_SPEED_MS);
}

// type: success | error
function showMessage(message, type) {
    var $alertBox = $('.mail-response');

    if ($alertBox.is(':visible')) {
        $alertBox.finish();
    }

    if (type === 'success') {
        $alertBox.html(message)
                 .removeClass('alert-success alert-error')
                 .addClass('alert-success')
                 .show()
                 .delay(ALERT_SHOW_DELAY_MS)
                 .fadeOut(ALERT_FADE_OUT_MS);
    } else if (type === 'error') {
        $alertBox.html(message)
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
        var $form = $('form[name="form-email"]');
        var data = $form.serializeArray();
        $form.find('fieldset').prop('disabled', true);

        // post data to server to send as an e-mail
        $.post('sendemail.php', data, function(response, status) {
            var result = JSON.parse(response);
            showMessage(result.message, result.status);
            $form.find('fieldset').prop('disabled', false);
        });
    } catch (ex) {
        throw new Error(ex.message);
    }    
}

function showContact($card) {
    //return false; // may be used for trial period
    
    // hide arrow
    $('.contact-arrow-container').slideUp(SLIDE_SPEED_MS);

    var $card = $($card);

    var showForm = function showForm() {
        // show form
        $card.siblings('.form-container').slideDown(SLIDE_SPEED_MS);

        // scroll to card top
        scrollToItem($card);
    };

    $card.addClass('open');
    if ($card.outerWidth() !== $('main').width()) { // width is not 100%
        $card.animate({ width: '100%' }, SLIDE_SPEED_MS, showForm);
    } else {
        showForm();
    }
}

function resizeCaptcha() {
    var width = window.innerWidth - 90; // 2*45 px on the sides
            
    if (width >= 302) return;
    
    var scale = Math.max(width / 302, CAPTCHA_MIN_SCALE);
    $captchaContainer.css({
        'transform': 'scale(' + scale + ')',
        'transform-origin': '0 0'
    });
}

// function refreshCaptcha() {
//     $.get({
//         url: 'getcaptcha.php',
//         cache: false
//     }, function(response, status) {
//         if (status === 'success') {
//             var data = JSON.parse(response);
//             $('.captcha-img').attr('src', data.image);
//             $('.captcha-hash').val(data.hash);
//         } else {
//             showMessage(ERROR_LOAD_CAPTCHA, 'error');
//         }
//     });
// }