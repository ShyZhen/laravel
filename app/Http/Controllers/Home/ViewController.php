<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/21
 * Time: 18:30
 */

namespace App\Http\Controllers\Home;


use Yuansir\Toastr\Facades\Toastr;

class ViewController
{
    public function index()
    {
        echo ('view');
    }

    public function test1()
    {
        return view('home.test',['a'=>123])->with('b', '456');
    }

    public function test2()
    {
        return view('home.child',['name' => "<script>alert('000')</script>"]);
    }

    public function css()
    {
        flash('成功了!!!')->success();
        Toastr::success('您已成功搞定', '成功', $options = []);
        return view('home.css');
    }
}