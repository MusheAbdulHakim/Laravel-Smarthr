<?php

namespace App\Http\Controllers;

use App\Helpers\AppMenu;
use App\Http\Controllers\BaseController;
use LaravelLang\LocaleList\Locale;

class DashboardController extends BaseController
{

    public function index()
    {
        $this->data['pageTitle'] = __('Dashboard');

        return view('pages.dashboard', $this->data);
    }
}
