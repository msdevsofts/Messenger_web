"use strict";

$(function () {
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
        let postMessage = new PostMessage();
        return false;
    })
});

class PostMessage {

}
