<?php


namespace App\Services;


use App\Contact;
use App\ContactRequest;

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
}
