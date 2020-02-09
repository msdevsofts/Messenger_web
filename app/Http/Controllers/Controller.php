<?php

namespace App\Http\Controllers;

use App\Services\ViewService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $scripts = [];
    protected $viewData = [];

    public function __construct() {
        $this->viewData = [
            'scripts' => $this->scripts
        ];
    }
}
