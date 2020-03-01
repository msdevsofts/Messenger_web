<?php

namespace App\Http\Controllers;

use App\Member;
use App\Services\LoginService;
use App\Services\MemberService;
use App\Services\ViewService;
use App\System\Utils\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request) {
        $loginService = new LoginService();
        $uid = session('unique_id', '');
        $pw = session('hash', '');
        if (!$loginService->validation($uid, $pw)) {
            return $loginService->logout();
        }

        // パスワード検証
        $password = session('hash', '');
        if (!empty($request->input('password'))
            && Hash::hash512($request->input('password')) === $password)
        {
            $newPw = $request->input('new_password') ?? '';
            $pwConfirm = $request->input('new_pw_confirm') ?? '';
            if (!empty($newPw) && $newPw === $pwConfirm) {
                $password = Hash::hash256($newPw);
            }
        }

        $memberService = new MemberService();
        $memberService->update(
            $loginService->getMemberId(),
            $password,
            $request->input('nickname') ?? $loginService->getNickname(),
            $request->input('sex') ?? $loginService->getSex()
        );

        return redirect()->to('/');
    }
}
