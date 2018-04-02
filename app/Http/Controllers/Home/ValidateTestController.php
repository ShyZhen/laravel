<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateTestController extends Controller
{


    private function VerifyToken(Request $request, $rules)
    {
        $validator = $this->validate($request, $rules);
        if ($validator->fails()) {

            return [
                'status_code' => 0,
                'message' => trans('mobile.params_error')
            ];
        }
    }

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
        $validate = $this->validate($request, [
            'name' => 'required|max:10',
            'email' => 'required|max:32',
        ],[
            'name.required' => '名字bixu必须',
            'email.required' => '邮箱必须',
        ]);

//        $rules = [
//            'name' => 'required|max:10',
//            'email' => 'required|max:32',
//        ];
//        $validate = $this->VerifyToken($request, $rules);

        dd($validate);
    }

}
