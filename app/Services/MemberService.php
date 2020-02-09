<?php


namespace App\Services;


use App\Member;
use App\System\Utils\Hash;

class MemberService
{
    /**
     * 登録
     *
     * @param string $uid ユニークID
     * @param string $pw パスワード
     * @param string $nickname (optional) ニックネーム
     * @param int $sex (optional) 性別
     * @return bool
     */
    public function register(string $uid, string $pw, string $nickname = '', int $sex = 0) {
        if ($this->isDuplicateUid($uid)) return false;

        return Member::insert([
            'unique_id' => $uid,
            'password'  => Hash::hash512($pw),
            'nickname'  => $nickname,
            'sex'       => $sex
        ]);
    }

    /**
     * メンバー情報を更新する
     *
     * @param int $memberId メンバーID
     * @param string $pw パスワード
     * @param string $nickname ニックネーム
     * @param string $sex 性別
     */
    public function update(int $memberId, string $pw, string $nickname, string $sex) {
        $member = Member::find($memberId);
        $member->pw = Hash::hash512($pw);
        $member->nickname = $nickname;
        $member->sex = $sex;
        $member->save();
    }

    /**
     * メンバーを削除する
     *
     * @param int $memberId メンバーID
     * @return bool 削除の成否
     */
    public function remove(int $memberId) {
        $member = Member::find($memberId);
        $member->removed_at = date('Y-m-d H:i:s');
        return $member->save();
    }

    /**
     * ユニークIDの重複チェック
     *
     * @param string $uid ユニークID
     * @return bool 確認結果
     */
    private function isDuplicateUid(string $uid) {
        $tmp = Member::where([ 'unique_id' => $uid ])->pluck('id')->toArray();
        return !empty($tmp);
    }
}
