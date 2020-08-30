<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\MessageListService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class MessageListController extends Controller
{
    protected $scripts = [
        'common/Overlay',
        'message/new',
        'message/adjustSize'
    ];

    public function index()
    {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $messageListService = new MessageListService($loginService->getMemberId());
        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'list' => $messageListService->getMessageList(),
            'contacts' => $contactService->getContacts()
        ];

        $viewService = new ViewService();
        return view($viewService->getMessageListView(), $this->viewData);
    }

    public function create(Request $request) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $memberIdList = $request->post('member') ?? array();
        if (empty($memberIdList)) {
            redirect()->route('message.list');
        }

        $messageListService = new MessageListService($loginService->getMemberId());
        $messageListId = $messageListService->addMessageList($memberIdList);
        return redirect()->route('message', [ 'id' => $messageListId ]);
    }
}
