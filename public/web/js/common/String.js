'use strict';

/**
 * 空文字確認
 *
 * @returns {boolean}
 */
String.prototype.isEmpty = function () {
    return this === undefined || this == null || this.length === 0;
};

/**
 * 整数変換
 *
 * @returns {number}
 */
String.prototype.toInt = function () {
    return parseInt(this);
}

/**
 * 浮動小数点変換
 *
 * @returns {number}
 */
String.prototype.toFloat = function () {
    return parseFloat(this);
}
