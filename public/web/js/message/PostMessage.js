"use strict";

class PostMessage extends SendData {
    constructor(url, method) {
        super(url, method);
    }

    onSuccess(data) {
        super.onSuccess(data);
        $('input:submit').removeAttr('disabled');

        if (data.status === 400) {
            this.onError();
            return;
        }

        $('textarea[name=message]').val('');
        $.each(data.data, function (k, v) {
            if ($('#id' + v.id).length === 0) {
                let balloon = BalloonBuilder.buildBalloonElements(v);
                if (k === 0) {
                    $('#messageList').append(balloon);
                }
                else {
                    $('#id' + data.data[k - 1].id).after(balloon);
                }
            }
        });

        let messageList = $('#messageList');
        messageList.animate({ scrollTop: messageList.height() }, 'fast');
    }

    onError() {
        super.onError();
        alert('送信できませんでした。');
    }
}
