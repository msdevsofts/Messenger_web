<?php

namespace App\Http\Controllers;

use App\Message;
use App\Services\ContactService;
use App\Services\LoginService;
use App\Services\MessageListService;
use App\Services\MessageService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $scripts = [
        'message/BalloonBuilder',
        'message/PostMessage',
        'message/message',
        'message/adjustSize',
        'message/new'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $response = [];
        $message = $request->post('message') ?? '';
        $lastLoadId = $request->post('last_load') ?? 0;
        if (!empty($message)) {
            $messageService = new MessageService($loginService->getMemberId());

            $result = [];
            if ($messageService->postMessage($id, $message)) {
                $result = $messageService->getLatestMessage($id, $lastLoadId);
            }

            if (empty($result)) {
                $response = [
                    'status' => 400,
                    'message' => 'failure'
                ];
            }
            else {
                $response = [
                    'status' => 200,
                    'data' => $result
                ];
            }
        }

        exit(json_encode($response));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id, Message $message)
    {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        $messageListService = new MessageListService($loginService->getMemberId());
        $messageService = new MessageService($loginService->getMemberId());
        $contactService = new ContactService($loginService->getMemberId());
        $this->viewData += [
            'id' => (int)$id,
            'memberId' => $loginService->getMemberId(),
            'list' => $messageListService->getMessageList(),
            'messages' => $messageService->getMessage($id),
            'contacts' => $contactService->getContacts()
        ];

        $viewService = new ViewService();
        return view($viewService->getMessageListView(), $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
