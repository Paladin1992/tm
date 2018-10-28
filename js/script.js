"use strict";

var menuButton;

$(document).ready(function() {

    menuButton = $('button');
    menuButton.on('click', function() {
        if ($('.navbar-collapse.collapse').hasClass('in')) { // open -> close
            menuButton.removeClass('opened');
        } else { // closed -> open
            menuButton.addClass('opened');
        }
    });
});