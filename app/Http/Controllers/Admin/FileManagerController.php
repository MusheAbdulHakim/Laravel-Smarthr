<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index(){
        $title = "File Manager";
        return view('backend.filemanager',compact('title'));
    }
}
