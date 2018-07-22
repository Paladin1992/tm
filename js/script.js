"use strict";

var $button = $('button');

$(document).ready(function() {

    $button.on('click', function() {
        if ($('.navbar-collapse.collapse').hasClass('in')) { // open -> close
            $button.removeClass('opened');
        } else { // closed -> open
            $button.addClass('opened');
        }
    });

});