<?php


namespace App\Services;


use App\Message;
use App\System\Utils\Network;

class MessageService
{
    private $memberId = 0;

    public function __construct(int $memberId) {
        $this->memberId = $memberId;
    }

    /**
     * メッセージを取得する
     *
     * 新しい順で取得したメッセージを array_reverse で古い順にソートしている。<br>
     * オフセットは最新の20件より前のメッセージを取得するためのページング用。
     *
     * @param int $messageListId メッセージリストID
     * @param int $offset オフセット（初期値: 0、最新のものから取得）
     * @return array メッセージ
     */
    public function getMessage(int $messageListId, int $offset = 0) {
        $messages = Message::where([ 'message_list_id' => $messageListId ])
            ->whereNull('removed_at')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->offset($offset)
            ->get([ 'id', 'member_id', 'message', 'created_at', 'updated_at' ])
            ->toArray();
        return array_reverse($messages);
    }

    /**
     * 指定メッセージID移行のメッセージをすべて取得する
     *
     * @param int $messageListId メッセージリストID
     * @param int $lastId 取得済み最終メッセージID
     * @return array メッセージ
     */
    public function getLatestMessage(int $messageListId, int $lastId = 0) {
        $messages = Message::where([ 'message_list_id' => $messageListId ])
            ->whereNull('removed_at')
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'desc')
            ->get([ 'id', 'member_id', 'message', 'created_at', 'updated_at' ])
            ->toArray();
        return array_reverse($messages);
    }

    /**
     * メッセージを投稿する
     *
     * @param int $messageListId メッセージリストID
     * @param string $message メッセージ
     * @return bool 投稿結果
     */
    public function postMessage(int $messageListId, string $message): bool {
        $newMessage = new Message();
        $newMessage->message_list_id = $messageListId;
        $newMessage->member_id = $this->memberId;
        $newMessage->message = $message;
        $newMessage->ipv4 = Network::getIpv4Addr();
        $newMessage->ipv6 = Network::getIpv6Addr();
        return $newMessage->save();
    }

    /**
     * メッセージを更新する
     *
     * @param int $messageId メッセージID
     * @param string $message メッセージ
     * @return bool 更新の成否
     */
    public function updateMessage(int $messageId, string $message): bool {
        $message = Message::find($messageId);
        $message->message = $message;
        return $message->save();
    }
}
