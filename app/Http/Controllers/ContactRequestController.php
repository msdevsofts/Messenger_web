<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index() {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

    }

    public function store(Request $request) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

    }

    public function show() {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'contacts' => $contactService->getReceivedContactRequests()
        ];

        $viewService = new ViewService();
        return view($viewService->getReceivedContactRequestView(), $this->viewData);
    }
}
