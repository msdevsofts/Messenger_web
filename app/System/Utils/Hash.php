<?php


namespace App\System\Utils;


class Hash
{
    private const SALT  = 'uQ7.r),F&&vAeu-N#,Rjmh+8U7PcAuS9';

    private const HASH_256  = 'sha256';
    private const HASH_512  = 'sha512';

    public static function hash256($str): string {
        return self::hash($str, self::HASH_256);
    }

    public static function hash512($str): string {
        return self::hash($str, self::HASH_512);
    }

    private static function hash(string $str, string $algo): string {
        return hash($algo, $str . self::SALT);
    }
}
