<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main_page()
    {
        return view('main-page');
    }
}
