<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        $title = 'activity';
        return view('backend.activity',compact(
            'title'
        ));
    }
}
