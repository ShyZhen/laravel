<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateTestController extends Controller
{
    //
    public function index()
    {
        dd('validateTest');
    }

    public function create()
    {
        return view('post.create');
    }
}
