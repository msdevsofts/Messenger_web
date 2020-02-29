$(function() {
    $('.edit').click(function() {
        let container = $(this).parents('.container');
        if (container.hasClass('nickname')) {
            let nicknameSpan = $(this).parents('p').find('.nickname');
            let nicknameInput = $('#nickname');
            if (nicknameSpan.css('display') === 'none') {
                nicknameSpan.css('display', 'inline-block');
                nicknameInput.attr('type', 'hidden');
                let nickname = nicknameInput.val().isEmpty() ? Default.NICKNAME : nicknameInput.val();
                nicknameSpan.text(nickname);
            }
            else {
                nicknameSpan.css('display', 'none');
                nicknameInput.attr('type', 'text');
                nicknameInput.removeAttr('style');
            }
        }
        else if (container.hasClass('password')) {
            $(this).css('display', 'none');
            $(this).parents('p').find('.password').css('display', 'none');
            $('#password').removeClass('hide').addClass('text-520');
        }
        return false;
    });

    $('.prof input:reset').click(function(e) {
        let nicknameSpan = $('.prof span.nickname');
        nicknameSpan.css('display', 'inline-block').text(initialData['nickname']);
        nicknameSpan.siblings('input').attr('type', 'hidden');
        $('.prof span.password').css('display', 'inline-block');
        $('.prof #password').css('display', 'none');
        $('.prof #privacy').prop('checked', initialData['isDenySearch']);
    });
});
