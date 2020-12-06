"use strict";

$(function() {
    $('#register').click(function() {
        let pwConf = $('.hide.pw_confirm');
        let ret = pwConf.toggle();
        let isNone = pwConf.css('display') === 'none';
        $(this).text(isNone ? '登録する' : 'ログインする');
        $('input:submit').val(isNone ? 'ログイン' : '登録');

        let height = isNone ? 178 : 226;
        $('form').css({'height': height});
    })
});
