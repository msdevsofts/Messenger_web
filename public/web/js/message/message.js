"use strict";

$(function () {
    let messageList = $('#messageList');
    messageList.animate({ scrollTop: messageList.height() }, 'fast');

    $('.message textarea').keydown(function (e) {
        if (e.isComposing) return true;

        if (e.code === 'Enter') {
            $(this).attr('rows', parseInt($(this).attr('rows')) + 1);
        }
        else if (e.code === 'Backspace' || e.code === 'Delete') {
            let line = $(this).val().match(/[\n\r]/g);
            let rows = line === null ? 1 : line.length;
            $(this).attr('rows', rows);
        }
    });

    $('form').submit(function () {
        return false;
    })

    $('input:submit').click(function () {
        let message = $('.message textarea').val().trim();
        if (!message.isEmpty()) {
            let lastLoadId = 0;
            let tmp = messageList.children('.message:last').attr('id').match(/^id([0-9]+)$/);
            if (tmp[1] !== undefined) {
                lastLoadId = tmp[1];
            }

            let form = $(this).parents('form');
            let postMessage = new PostMessage(form.attr('action'), form.attr('method'));
            postMessage.send({
                message: message,
                _token: form.children('input:hidden[name=_token]').val(),
                last_load: lastLoadId
            });
            $('input:submit').attr('disabled', 'disabled')
        }
    });
});
