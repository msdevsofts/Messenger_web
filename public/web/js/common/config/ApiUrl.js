'use strict';

class ApiUrl {
    static KEY_CONTACTS = 'contacts';

    constructor() {
        this.__base = 'https://msg.local.develop';
        this.__urlList = {};
        this._setUrl();
    }

    _setUrl() {
        this.__urlList = {
            contacts: {
                sendRequest: '/contacts/request/send',
                updateRequest: '/contacts/request/update'
            }
        };
    }

    getUrl(key) {
        return this.__urlList[key] || '';
    }
}
