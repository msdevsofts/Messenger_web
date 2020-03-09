<?php


namespace App\Services;


use App\Contact;
use App\ContactRequest;
use App\Member;

class ContactService
{
    private $memberId;

    public function __construct($memberId)
    {
        $this->memberId = $memberId;
    }

    public function getContacts() {
        $contacts = Contact::join('members', 'members.id', '=', 'contacts.target_id')
            ->where([
                'contacts.id' => $this->memberId,
                'contacts.removed_at' => null,
                'members.removed_at' => null
            ])
            ->orderBy('members.nickname')
            ->get([
                'members.id',
                'members.unique_id',
                'members.nickname'
            ])->toArray();
        return $contacts ?? [];
    }

    public function getContactDetail($targetId) {
        $contact = Contact::join('members', 'members.id', '=', 'contacts.target_id')
            ->where([
                'contacts.id' => $this->memberId,
                'contacts.target_id' => $targetId,
                'contacts.deleted_at' => null,
                'members.removed_at' => null
            ])
            ->get([
                'members.id',
                'members.unique_id',
                'members.nickname',
                'members.sex'
            ])->toArray();
        return $contact[array_key_first($contact)] ?? [];
    }

    public function getRequestableContacts(? string $searchName = '') {
        $query = Member::leftJoin('contacts', function ($join) {
                $join->on('contacts.target_id', '=', 'members.id')
                    ->where('contacts.id', '=', $this->memberId);
            })
            ->where([
                'contacts.removed_at' => null,
                'members.removed_at' => null
            ])
            ->where('members.id', '<>', $this->memberId);
        if (!empty($searchName)) {
            $query->where(function ($query) use ($searchName) {
                $tmp = '%' . $searchName . '%';
                $query->where('members.unique_id', 'LIKE', $tmp)
                    ->orWhere('members.nickname', 'LIKE', $tmp);
            });
        }

        return $query->get([
                'members.id',
                'members.unique_id',
                'members.nickname',
                'members.sex'
            ])
            ->toArray();
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
}
