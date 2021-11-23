<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextPortraitsController extends Controller
{
    public function index()
    {
        return view('text-portraits.index');
    }
}
