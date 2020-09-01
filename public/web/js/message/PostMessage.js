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
            let form = $(this).parents('form');
            let url = form.attr('action');
            let method = form.attr('method');
            let data = { message: message, _token: form.children('input:hidden[name=_token]').val() }
            new PostMessage(url, method, $('#messageList')).send(data);
            $('input:submit').attr('disabled', 'disabled')
        }
    });
});

class PostMessage extends SendData {
    constructor(url, method, messageList) {
        super(url, method);
        this._messageList = messageList;
    }

    onSuccess(data) {
        super.onSuccess(data);
        $('input:submit').removeAttr('disabled');

        if (data.status === 400) {
            this.onError();
            return;
        }

        $('textarea[name=message]').val('');
        this._messageList.append(
            $('<div>', { class: 'message clear self right', id: 'id' + data.data.id })
                .append(
                    $('<div>', { class: 'left' }).append(
                        $('<div>', { class: 'clear' }).append(
                            $('<span>', { class: 'balloon right', text: data.data.message })
                        )
                    ).append(
                        $('<div>').append(
                            $('<span>', { class: 'at', text: data.data.created_at })
                        )
                    )
                )
        );

        let messageList = $('#messageList');
        messageList.animate({ scrollTop: messageList.height() }, 'fast');
    }

    onError() {
        super.onError();
        alert('送信できませんでした。');
    }
}
