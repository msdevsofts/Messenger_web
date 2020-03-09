<?php


namespace App\Services;


use App\Contact;
use App\ContactRequest;

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
