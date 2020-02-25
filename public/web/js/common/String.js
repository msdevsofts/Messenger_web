'use strict';

/**
 * 空文字確認
 *
 * @returns {boolean}
 */
String.prototype.isEmpty = function () {
    return this === undefined || this == null || this.length === 0;
};
