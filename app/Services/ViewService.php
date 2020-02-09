<?php


namespace App\Services;


use App\System\Config\Config;
use Illuminate\Support\Facades\Route;

class ViewService
{
    private $config;
    private $scripts;

    public function __construct() {
        $this->config = new Config();
    }

    /**
     * @param mixed $scripts
     */
    public function setScripts(array $scripts): void {
        $this->scripts = $scripts;
    }

    /**
     * @return mixed
     */
    public function getScripts() {
        return $this->scripts;
    }

    public function getLoginView() {
        return $this->getViewRoot() . '/login';
    }

    public function getLoggedInIndexView() {
        return $this->getViewRoot() . '/index';
    }

    private function getViewRoot() {
        return $this->config->getViewRoot(Route::current()->getDomain());
    }
}
