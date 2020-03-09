<?php

namespace App\Http\Controllers;

use App\Services\ContactRequestService;
use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class ContactReceivedRequestController extends Controller
{
    public function show() {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactRequestService = new ContactRequestService($loginService->getMemberId());
        $this->viewData += [
            'members' => $contactRequestService->getReceivedContactRequests()
        ];

        $viewService = new ViewService();
        return view($viewService->getReceivedContactRequestView(), $this->viewData);
    }
}
