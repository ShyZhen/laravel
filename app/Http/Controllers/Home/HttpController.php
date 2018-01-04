<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/29
 * Time: 16:32
 */

namespace App\Http\Controllers\Home;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HttpController
{
    public function index()
    {
        dd('hello world');
    }

    public function param(Request $request, $pId, $cId)
    {
//        dd($request->url().'---'.$request->fullUrl());
        dd($pId.' & '.$cId.' & '.$request->age);
    }
    public function redirect()
    {
        return redirect()->route('he');
    }
    public function model()
    {
        dd('model function');
    }

    public function flashTest(Request $request)
    {
        $request->flash();
    }

    public function getSession(Request $request)
    {
        dd($request->old('username'));
    }

    public function getCoolie(Request $request)
    {
        $cookie = cookie('test', 'value123', 1, null, null, false);
        dd($cookie);
//        dd(Cookie::get('test'));


        dd($request->cookie());
    }

    public function upload(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('home.upload');
        } elseif ($request->isMethod('post')) {
            $fileImg = $request->file('fileimg');
            $fileImgPath = $fileImg->path(); // 缓存到系统的tmp文件
            $fileImgExt= $fileImg->extension(); //源文件的后缀
//            dd($fileImgPath.' & '.$fileImgExt);

            $path = $fileImg->store('image', 'public');   //dd(asset('storage/'.$path));
            dd($path);
        }
    }
}