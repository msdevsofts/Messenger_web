'use strict';

$(function () {
    $('#request').submit(function () {
        return false;
    });

    $('input:submit').click(function () {
        let tmp = $(this).attr('name').match(/\[([^\]]+)\]/);
        new Request(tmp[1] || 0).send({});
    });
});

class Request extends SendData {
    constructor(targetId) {
        let url = new ApiUrl().getUrl(ApiUrl.KEY_CONTACTS);
        super(url.sendRequest + '/' + targetId, 'get');
    }

    onSuccess(data) {
        super.onSuccess(data);
        alert('申請しました');
    }

    onError() {
        super.onError();
    }
}
