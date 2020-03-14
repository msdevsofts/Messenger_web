'use strict';

class SendData {
    constructor(url, method) {
        this._url = url;
        this.method = method;
    }

    send(data) {
        $.ajax({
            url: this._url,
            type: this.method,
            dataType: "json",
            data: data
        })
            .then(
                this.onSuccess(data),
                this.onError()
            );
    }

    onSuccess(data) {}

    onError() {}
}
