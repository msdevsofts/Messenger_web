"use strict";

$(function () {
    adjustSize();
    $(window).resize(function () {
        adjustSize();
    });

    function adjustSize() {
        // 左側親要素のサイズ調整
        let content = $('.sidebar + .container.left');
        let margin = content.css('marginTop').toInt()
        let height = $(window).height() - content.offset().top - margin;
        content.css('height', height);

        // メッセージ一覧のサイズ調整
        let messageList = content.children('.container.message_list');
        let contentHeight = height - messageList.css('marginTop').toInt() - messageList.css('marginBottom').toInt();
        messageList.css('height', contentHeight);

        // メッセージ履歴の調整
        let message = $('#messageList');
        if (message.length > 0) {
            messageList.next().css('height', height);
            messageList.next().css('maxHeight', height);

            // メッセージ送信ボックスの位置調整
            let sendBox = message.next()
            margin = sendBox.css('marginTop').toInt() + sendBox.css('marginBottom').toInt();
            contentHeight = height - sendBox.height() - margin - message.css('marginTop').toInt();
            message.css('height', contentHeight);
            message.css('maxHeight', contentHeight);
        }
    }
});
