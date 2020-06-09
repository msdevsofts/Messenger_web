<?php


namespace App\Services;


use App\MessageList;
use Illuminate\Support\Facades\DB;

class MessageListService
{
    private $memberId = 0;

    public function __construct(int $memberId)
    {
        $this->memberId = $memberId;
    }

    public function getMessageList() {
        return MessageList::join('message_members', 'message_members.id', '=', 'message_lists.id')
            ->joinSub(
                function ($query) {
                    $query->select([
                            DB::raw('distinct(message_list_id)'),
                            'message',
                            'created_at'
                        ])
                        ->from('messages')
                        ->where(['member_id' => $this->memberId])
                        ->whereNotNull('removed_at');
                },
                'latest_messages',
                'latest_messages.message_list_id',
                '=',
                'message_lists.id'
            )
            ->where(['message_members.member_id' => $this->memberId])
            ->orderBy('latest_messages.created_at', 'desc')
            ->orderBy('message_lists.created_at', 'desc')
            ->get([
                'message_lists.id',
                'message_lists.name',
                'latest_messages.message'
            ])
            ->toArray();
    }
}
