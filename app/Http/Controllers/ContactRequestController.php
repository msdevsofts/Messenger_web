<?php

namespace App\Http\Controllers;

use App\Services\ContactRequestService;
use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    protected $scripts = [
        'contacts/request'
    ];

    public function index() {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'members' => $contactService->getRequestableContacts()
        ];

        $viewService = new ViewService();
        return view($viewService->getContactRequestView(), $this->viewData);
    }

    public function store($id) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        if ($id == 0) {
            exit(json_encode([
                'status' => 400,
                'message' => 'traget id is incorrect'
            ]));
        }

        $response = [];
        $contactRequestService = new ContactRequestService($loginService->getMemberId());
        if ($contactRequestService->request((int)$id)) {
            $response = [ 'status' => 200 ];
        }
        else {
            $response = [
                'status' => 400,
                'message' => 'failure'
            ];
        }
        exit(json_encode($response));
    }

    public function show(Request $request) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'members' => $contactService->getRequestableContacts($request->input('name') ?? '')
        ];

        $viewService = new ViewService();
        return view($viewService->getContactRequestView(), $this->viewData);
    }
}
