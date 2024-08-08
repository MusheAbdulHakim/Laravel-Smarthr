<?php

namespace Modules\Whiteboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WhiteboardController extends Controller
{
   
    public function tldraw()
    {
        $pageTitle = __('TlDraw App');
        return view('whiteboard::tldraw',compact(
            'pageTitle'
        ));
    }


    public function excalidraw()
    {
        $pageTitle = __('TlDraw App');
        return view('whiteboard::excalidraw',compact(
            'pageTitle'
        ));
    }
}
