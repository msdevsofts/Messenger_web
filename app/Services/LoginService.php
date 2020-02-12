<?php


namespace App\Services;


use App\Administrator;
use App\Member;
use App\System\Config\Config;
use App\System\Utils\Hash;
use Illuminate\Support\Facades\Route;

class LoginService
{
    /**
     * ログイン
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return bool ログインの成否
     */
    public function login(string $uid, string $pw): bool {
        $memberId = $this->getMemberId($uid, $pw);
        if ($memberId === 0) return false;

        session()->regenerate();
        session([
            'id'        => $memberId,
            'unique_id' => $uid,
            'hash'      => Hash::hash512($pw)
        ]);

        return true;
    }

    /**
     * ログイン検証
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return bool 検証結果
     */
    public function validation(string $uid, string $pw): bool {
        return $this->getMemberId($uid, Hash::hash512($pw)) > 0;
    }

    /**
     * メンバーIDを取得する
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return int メンバーID（取得できなければ 0）
     */
    private function getMemberId(string $uid, string $pw): int {
        $where = [
            'unique_id' => $uid,
            'password'  => Hash::hash512($pw)
        ];

        $id = 0;
        $config = new Config();
        if ($config->isMain(Route::current()->getDomain())) {
            $member = Member::where($where)->pluck('id');
            $id = $member[0] ?? 0;
        }
        else {
            $admin = Administrator::where($where)->pluck('id');
            $id = $admin[0] ?? 0;
        }

        return $id;
    }
}
