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
        return MessageList::join('message_members', 'message_members.id', '=', 'message_lists.id')
            ->leftJoinSub(
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
