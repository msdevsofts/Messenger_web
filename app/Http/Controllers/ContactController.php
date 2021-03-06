<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\ViewService;

class ContactController extends Controller
{
    public function index() {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'contacts' => $contactService->getContacts()
        ];

        $viewService = new ViewService();
        return view($viewService->getContactListView(), $this->viewData);
    }

    public function show($id) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'detail' => $contactService->getContactDetail($id)
        ];

        $viewService = new ViewService();
        return view($viewService->getContactDetailView(), $this->viewData);
    }
}
