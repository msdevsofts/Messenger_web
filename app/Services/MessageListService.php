<?php


namespace App\Services;


use App\Member;
use App\MessageList;
use App\MessageMember;
use Illuminate\Support\Facades\DB;

class MessageListService
{
    private $memberId = 0;

    public function __construct(int $memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * メッセージ一覧を取得する
     *
     * @return array メッセージ一覧
     */
    public function getMessageList(): array {
        return MessageList::select([
                'message_lists.id',
                'message_lists.name',
                'messages.message',
            'messages.created_at'
            ])
            ->join('message_members', 'message_members.id', '=', 'message_lists.id')
            ->join('messages', function ($join) {
                $join->on('messages.message_list_id', '=', 'message_lists.id')
                    ->whereIn('messages.id', function ($query) {
                        $query->select([DB::raw('MAX(id) AS id')])
                            ->from('messages')
                            ->whereNull('removed_at')
                            ->groupBy('message_list_id');
                    });
            })
            ->where(['message_members.member_id' => $this->memberId])
            ->unionAll(MessageList::join('message_members', 'message_members.id', '=', 'message_lists.id')
                ->select([
                    'message_lists.id',
                    'message_lists.name',
                    DB::raw('NULL AS message'),
                    'message_lists.created_at'
                ])
                ->leftJoin('messages', 'messages.message_list_id', '=', 'message_lists.id')
                ->where(['message_members.member_id' => $this->memberId])
                ->whereNull('messages.removed_at')
                ->whereNull('messages.id'))
            ->orderBy('created_at', 'desc')
            ->get([ '*' ])
            ->toArray();
    }

    /**
     * メッセージを作成する
     *
     * @param array $memberIdList メンバーIDリスト
     * @return int メッセージ一覧ID
     */
    public function addMessageList(array $memberIdList): int {
        if (empty($memberIdList)) return 0;

        $memberIdList[] = $this->memberId;
        $memberIdList = array_unique($memberIdList);
        asort($memberIdList);

        $messageList = MessageList::join('message_members', 'message_members.id', '=', 'message_lists.id')
            ->whereIn('message_lists.id', function ($query) {
                $query->select([ 'id' ])
                    ->from('message_members')
                    ->where([ 'member_id' => $this->memberId ]);
            })
            ->groupBy('message_lists.id')
            ->having('member_list', '=', implode(',', $memberIdList))
            ->get([
                DB::raw('message_lists.id'),
                DB::raw('group_concat(message_members.member_id) as member_list')
            ])
            ->toArray();

        $messageListId = $messageList[0]['id'] ?? 0;
        if (empty($messageList)) {
            $memberList = array();
            $tmp = Member::whereIn('id', $memberIdList)
                ->get([ 'id', 'unique_id', 'nickname' ])
                ->toArray();
            foreach ($tmp as $val) {
                $memberList[$val['id']] = empty($val['nickname']) ? $val['unique_id'] : $val['nickname'];
            }

            $newMessageList = new MessageList();
            if (count($memberList) > 1) {
                $newMessageList->owner_member_id = $this->memberId;
            }
            $newMessageList->name = implode(', ', $memberList);
            $newMessageList->save();
            $messageListId = $newMessageList->id;

            $now = date('Y-m-d H:i:s');
            $tmp = [];
            foreach ($memberList as $id => $member) {
                $tmp[] = [
                    'id' => $messageListId,
                    'member_id' => $id,
                    'created_at' => $now
                ];
            }
            MessageMember::insert($tmp);
        }

        return $messageListId;
    }
}
