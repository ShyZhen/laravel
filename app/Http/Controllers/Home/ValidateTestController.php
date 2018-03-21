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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
            'email' => 'required|max:32',
        ]);

//        if ()
        dd();
    }

}
