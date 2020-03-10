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
        if ((data.status || 0) === 200) {
            alert('申請しました');
        }
        else {
            alert('申請に失敗しました');
        }
    }

    onError() {
        super.onError();
    }
}
