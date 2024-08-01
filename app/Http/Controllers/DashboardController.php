<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Helpers\AppMenu;
use LaravelLang\LocaleList\Locale;
use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{

    public function index()
    {
        $this->data['pageTitle'] = __('Dashboard');
        if(auth()->user()->type === UserType::EMPLOYEE)
        {
            return view('pages.employees.dashboard',$this->data);
        }
        return view('pages.dashboard', $this->data);
    }
}
