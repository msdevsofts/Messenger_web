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

    public function getRequestableContacts() {
        $contacts = Contact::where([
                'id' => $this->memberId,
                'removed_at' => null
            ])
            ->pluck('target_id')->toArray();
        $contacts = Member::whereNotIn('id', $contacts)
            ->get([
                'members.id',
                'members.unique_id',
                'members.nickname',
                'members.sex'
            ])
            ->toArray();
        return $contacts;
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
