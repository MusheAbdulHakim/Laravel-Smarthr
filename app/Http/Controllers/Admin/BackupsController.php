<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupsController extends Controller
{
    public function index(){
        $title = 'backups';
        return view('backend.backups.index',compact(
            'title'
        ));
    }
}
