'use strict';

$(function () {
    let overlay = new Overlay();

    $('#mew_message').click(function() {
        overlay.show();

        let modal = $('.message_contact.modal');
        modal.css({
            display: 'block',
            position: 'fixed',
            top: ($(window).height() - modal.outerHeight()) / 2
        });

        return false;
    });

    $('.message_contact.modal .close').click(function() {
        $(this).parents('.modal').css('display', 'none');
        overlay.close();
    });
});
