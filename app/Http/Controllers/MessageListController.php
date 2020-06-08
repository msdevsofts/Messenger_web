<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use App\Services\MessageListService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class MessageListController extends Controller
{
    public function index()
    {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $messageListService = new MessageListService($loginService->getMemberId());
        $this->viewData += [
            'messageList' => $messageListService->getMessageList()
        ];
        dd($this->viewData['messageList']);

        $viewService = new ViewService();
        return view($viewService->getMessageListView(), $this->viewData);
    }
}
