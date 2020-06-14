'use strict';

class Overlay {
    constructor() {
        this.overlay = this._create();
        $('body').append(this.overlay);
    }

    _create() {
        return $('<div>', {
            id: 'overlay'
        }).css({
            display: 'none',
            backgroundColor: '#333',
            opacity: 0.6,
            position: 'fixed',
            top: 0,
            width: '100%',
            height: '100%'
        });
    }

    show() {
        this.overlay.css('display', 'block');
    }

    close() {
        this.overlay.css('display', 'none');
    }
}
