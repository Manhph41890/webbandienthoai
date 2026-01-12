<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HTTPStatusController extends Controller
{
    public function http404()
    {
        return view('pages.404');
    }
    public function http403()
    {
        return view('pages.403');
    }
}
