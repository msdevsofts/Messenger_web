<?php


namespace App\System\Utils;


class Network
{
    public static function getIpAddr() {
        return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    }

    public static function getIpv4Addr() {
        $ipAddr = self::getIpAddr();
        return self::isIpv4($ipAddr) ? $ipAddr : '';
    }

    public static function getIpv6Addr() {
        $ipAddr = self::getIpAddr();
        return self::isIpv6($ipAddr) ? $ipAddr : '';
    }

    public static function isIpv4(string $ipAddr) {
        return strpos($ipAddr, '.') !== false;
    }

    public static function isIpv6(string $ipAddr) {
        return strpos($ipAddr, ':') !== false;
    }
}
