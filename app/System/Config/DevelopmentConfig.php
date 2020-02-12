<?php


namespace App\System\Config;


class DevelopmentConfig
{
    private const ROOT_DIR = '/var/www/html/';
    private const MAIN_DIR = self::ROOT_DIR . 'main/public/';

    private const HOST_NAME_MAIN = 'msg.local.develop';
    private const HOST_NAME_ADM = 'adm.' . self::HOST_NAME_MAIN;
    private const HOST_NAME_API = 'api.' . self::HOST_NAME_MAIN;

    private const VIEW_ROOT_MAIN    = 'web';
    private const VIEW_ROOT_ADM     = 'admin';
    private const VIEW_ROOT         = [
        self::HOST_NAME_MAIN    => self::VIEW_ROOT_MAIN,
        self::HOST_NAME_ADM     => self::VIEW_ROOT_ADM
    ];

    private const IMAGE_DIR = self::ROOT_DIR . '/images/';

    private const SUPPORT_FILE_TYPES = [ 'jpg', 'png', 'gif', 'svg', 'webp' ];

    private const JS_MINIFY_TEST = false;

    public function getRootDir(): string {
        return self::ROOT_DIR;
    }

    public function getMainDir(): string {
        return self::MAIN_DIR;
    }

    public function getMainHostName(): string {
        return self::HOST_NAME_MAIN;
    }

    public function getAdmHostName(): string {
        return self::HOST_NAME_ADM;
    }

    public function getApiHostName(): string {
        return self::HOST_NAME_API;
    }

    public function getViewRoot(string $hostName) {
        return self::VIEW_ROOT[$hostName] ?? '';
    }

    public function isMain(string $hostName): bool {
        return self::VIEW_ROOT[$hostName] ?? '' === self::VIEW_ROOT_MAIN;
    }

    public function isAdmin(string $hostName): bool {
        return self::VIEW_ROOT[$hostName] ?? '' === self::VIEW_ROOT_ADM;
    }

    public function getImageDir(): string {
        return self::IMAGE_DIR;
    }

    public function getSupportFileTypes(): array {
        return self::SUPPORT_FILE_TYPES;
    }

    public function isJsMinify(): bool {
        return self::JS_MINIFY_TEST;
    }
}
