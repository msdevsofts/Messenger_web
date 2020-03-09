<?php


namespace App\Services;


use App\Contact;
use App\ContactRequest;
use App\Member;

class ContactRequestService
{
    private $memberId = 0;

    public function __construct($memberId)
    {
        $this->memberId = $memberId;
    }

    public function request(int $targetId) {
        // 申請の再送信はしない
        if ($this->isAlreadyExists($targetId) || $this->isSent($targetId)) {
            return false;
        }

        // 既に相手から申請があれば受け入れたとみなす
        if ($this->isReceived($targetId)) {
            $this->accept($targetId);
        }

        return ContactRequest::insertOrIgnore([
            'id' => $this->memberId,
            'target_id' => $targetId,
            'requested_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function accept($targetId) {}

    public function refuse($targetId) {}

    public function getRequestableContacts(? string $searchName = '') {
        $union = Contact::where([ 'id' => $this->memberId, 'removed_at' => null ])
            ->select([ 'id' ])
            ->union(ContactRequest::where([ 'target_id' => $this->memberId ])->select([ 'id' ]))
            ->union(ContactRequest::where([ 'id' => $this->memberId ])->select([ 'target_id AS id' ]));
        $query = Member::where('id', '<>', $this->memberId)
            ->whereNull('removed_at')
            ->whereNotIn('id', $union);
        if (!empty($searchName)) {
            $query->where(function ($query) use ($searchName) {
                $tmp = '%' . $searchName . '%';
                $query->where('unique_id', 'LIKE', $tmp)
                    ->orWhere('nickname', 'LIKE', $tmp);
            });
        }

        return $query->get([
            'id',
            'unique_id',
            'nickname',
            'sex'
        ])->toArray();
    }

    public function getReceivedContactRequests() {
        $contacts = ContactRequest::join('members', 'members.id', '=', 'contact_requests.id')
            ->where([
                'contact_requests.target_id' => $this->memberId,
                'contact_requests.accepted_at' => null,
                'contact_requests.refused_at' => null,
                'members.removed_at' => null
            ])
            ->orderBy('contact_requests.requested_at', 'desc')
            ->get([
                'members.id',
                'members.unique_id',
                'members.nickname',
                'contact_requests.requested_at'
            ])
            ->toArray();
        return $contacts ?? [];
    }

    private function isReceived($targetId) {
        $contacts = ContactRequest::where([
            'id' => $targetId,
            'target_id' => $this->memberId,
            'refused_at' => null,
        ])
            ->get()->toArray();
        return !empty($contacts);
    }

    public function isSent($targetId) {
        $contacts = ContactRequest::where([
            'id' => $this->memberId,
            'target_id' => $targetId
        ])
            ->get()->toArray();
        return !empty($contacts);
    }

    public function isAlreadyExists($targetId) {
        $contacts = Contact::where([
            'id' => $this->memberId,
            'target_id' => $targetId
        ])
            ->get()->toArray();
        return !empty($contacts);
    }
}
