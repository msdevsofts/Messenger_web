'use strict';

class SendData {
    constructor(url, method) {
        this._url = url;
        this.method = method;
        this.overlay = new Overlay();
    }

    send(data) {
        this.overlay.show();
        $.ajax({
            url: this._url,
            type: this.method,
            dataType: "json",
            data: data
        })
            .done((data) => this.onSuccess(data))
            .fail(() => this.onError())
    }

    onSuccess(data) {
        this.overlay.close();
    }

    onError() {
        this.overlay.close();
    }
}
