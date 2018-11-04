"use strict";

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
});

function loadVideos(page, destinationId) {
    $.get("loadvideos.php?p=" + page, function(data, status) {
        $('#' + destinationId).html(data);
    });
}