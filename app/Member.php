<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [ 'password', 'nickname', 'sex' ];

    public const SEX_NONE   = 0;
    public const SEX_MALE   = 1;
    public const SEX_FEMALE = 2;
    public static $sexList = [
        self::SEX_NONE      => '設定なし',
        self::SEX_MALE      => '男性',
        self::SEX_FEMALE    => '女性'
    ];
}
