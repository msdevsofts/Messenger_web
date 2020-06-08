<?php


namespace App\Services;


use App\MessageList;

class MessageListService
{
    private $memberId = 0;

    public function __construct(int $memberId)
    {
        $this->memberId = $memberId;
    }

    public function getMessageList() {
        return MessageList::join('message_members', 'message_members.id', '=', 'message_lists.id')
            ->join('messages', 'messages.message_list_id', '=', 'message_lists.id')
            ->where(['message_members.member_id' => $this->memberId])
            ->groupBy('message_lists.id')
            ->orderBy('messages.created_at', 'desc')
            ->orderBy('message_lists.created_at', 'desc')
            ->toSql();
/*
            ->get([
                'message_lists.id',
                'message_lists.name',
                'messages.message'
            ])
            ->toArray();
*/
    }
}
