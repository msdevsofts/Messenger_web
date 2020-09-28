"use strict";

class BalloonBuilder {
    static buildBalloonElements(messageData) {
        let isSelf = messageData.member_id === Profile.MEMBER_ID;
        let messageClass = 'message clear ' + (isSelf ? 'self right' : 'other');
        let wrapper = $('<div>', { class: messageClass, id: 'id' + messageData.id });
        if (!isSelf) {
            wrapper.append(
                $('<span>', { class: 'prof_img left', style: 'background-image: url(\'https://msg.local.develop/img/account_circle-24px.svg\')' })
            );
        }
        return wrapper
            .append(
                $('<div>', { class: 'left' }).append(
                    this._buildMessageElements(messageData.message, isSelf)
                ).append(
                    this._buildTimeElements(messageData.created_at)
                )
            );
    }

    static _buildMessageElements(message, isSelf) {
        let balloonClass = 'balloon' + (isSelf ? ' right' : '');
        return $('<div>', { class: 'clear' }).append(
            $('<span>', { class: balloonClass, text: message })
        );
    }

    static _buildTimeElements(createdAt) {
        return $('<div>').append(
            $('<span>', { class: 'at', text: createdAt })
        );
    }

}
