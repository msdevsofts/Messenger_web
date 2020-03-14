<?php


namespace App\Services;


use App\Administrator;
use App\Member;
use App\System\Config\Config;
use App\System\Utils\Hash;
use Illuminate\Support\Facades\Route;

class LoginService
{
    private $memberId       = 0;
    private $uniqueId       = '';
    private $nickname       = '';
    private $sex            = Member::SEX_NONE;
    private $registeredAt   = '';
    private $updatedAt      = '';

    /**
     * ログイン
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return bool ログインの成否
     */
    public function login(string $uid, string $pw): bool {
        $this->memberId = $this->getMemberIdByLoginInfo($uid, $pw);
        if ($this->memberId === 0) return false;

        session()->regenerate();
        session([
            'id'        => $this->memberId,
            'unique_id' => $uid,
            'hash'      => $pw
        ]);

        return true;
    }

    /**
     * ログアウト
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        session()->flush();
        return redirect()->to('/');
    }

    /**
     * ログイン検証
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return bool 検証結果
     */
    public function validation(string $uid, string $pw): bool {
        if ($this->getMemberIdByLoginInfo($uid, $pw) > 0) {
            $this->setMemberInfo();
            return true;
        }
        return false;
    }

    /**
     * メンバーIDを取得する
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @return int メンバーID（取得できなければ 0）
     */
    private function getMemberIdByLoginInfo(string $uid, string $pw): int {
        $where = [
            'unique_id' => $uid,
            'password'  => Hash::hash512($pw)
        ];

        $config = new Config();
        if ($config->isMain(Route::current()->getDomain())) {
            $member = Member::where($where)->pluck('id');
            $this->memberId = $member[0] ?? 0;
        }
        else {
            $admin = Administrator::where($where)->pluck('id');
            $this->memberId = $admin[0] ?? 0;
        }

        return $this->memberId;
    }

    private function setMemberInfo() {
        $member = Member::find($this->memberId);
        if (!empty($member)) {
            $this->uniqueId = $member->unique_id ?? '';
            $this->nickname = $member->nickname ?? '';
            $this->sex = $member->sex ?? Member::SEX_NONE;
            $this->registeredAt = $member->created_at ?? '';
            $this->updatedAt = $member->updated_at ?? $this->registeredAt;
        }
    }

    /**
     * @return int
     */
    public function getMemberId(): int {
        return $this->memberId;
    }

    /**
     * @return string
     */
    public function getUniqueId(): string {
        return $this->uniqueId;
    }

    /**
     * @return string
     */
    public function getNickname(): string {
        return $this->nickname;
    }

    /**
     * @return int
     */
    public function getSex(): int {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getRegisteredAt(): string {
        return $this->registeredAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }
}
