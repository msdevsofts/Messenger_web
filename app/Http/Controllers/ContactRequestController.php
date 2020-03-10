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

        $contactRequestService = new ContactRequestService($loginService->getMemberId());
        $this->viewData += [
            'members' => $contactRequestService->getRequestableContacts()
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

        $contactRequestService = new ContactRequestService($loginService->getMemberId());
        $this->viewData += [
            'members' => $contactRequestService->getRequestableContacts($request->input('name') ?? '')
        ];

        $viewService = new ViewService();
        return view($viewService->getContactRequestView(), $this->viewData);
    }

    public function update(Request $request) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $contactRequestService = new ContactRequestService($loginService->getMemberId());

        $accept = $request->post('accept') ?? [];
        foreach ($accept as $key => $val) {
            $contactRequestService->accept($key);
        }

        $refuse = $request->post('refuse') ?? [];
        foreach ($refuse as $key => $val) {
            $contactRequestService->refuse($key);
        }

        return redirect()->route('contact.request.recv');
    }
}
