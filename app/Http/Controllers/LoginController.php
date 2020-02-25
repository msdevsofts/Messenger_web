<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use App\Services\MemberService;
use App\Services\ViewService;
use App\System\Utils\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $scripts = [
        'login',
        'prof/edit'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $view = '';
        $viewService = new ViewService();

        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (empty($uid) || empty($pw)) {
            $view = $viewService->getLoginView();
        }
        else {
            $loginService = new LoginService();
            $view = $loginService->validation($uid, $pw)
                ? $viewService->getLoggedInIndexView() : $viewService->getLoginView();
            $this->viewData += [
                'uniqueId'  => $loginService->getUniqueId(),
                'nickname'  => $loginService->getNickname()
            ];
        }

        return view($view, $this->viewData);
    }

    public function show(Request $request) {
        $viewService = new ViewService();

        $uid = $request->input('unique_id');
        $pw = $request->input('password');
        $pwConfirm = $request->input('pw_confirm') ?? '';
        $isRegister = ($request->input('login') ?? 'ログイン') === '登録';

        // 登録
        if ($isRegister) {
            $memberService = new MemberService();
            if (!empty($uid) && !empty($pw) && $pw === $pwConfirm) {
                if ($memberService->register($uid, Hash::hash512($pw))) {
                    return redirect()->to('/');
                }
                $this->viewData['error'] = 'そのIDは既に登録されています';
            }
            else {
                $this->viewData['error'] = '入力項目に不備があります';
            }
        }
        // ログイン
        else {
            $loginService = new LoginService();
            if (!empty($uid) && !empty($pw) && $loginService->login($uid, Hash::hash512($pw))) {
                return redirect()->to('/');
            }
            $this->viewData['error'] = 'IDまたはパスワードが違います';
        }

        $this->viewData['isRegister'] = $isRegister;
        return view($viewService->getLoginView(), $this->viewData);
    }
}
