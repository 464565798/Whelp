<?php
namespace app\home\controller;
use think\Request;
class Error
{
// 空控制器会执行
    public function index(Request $request)
    {
        $city = $request->controller();
        // echo '<pre>';
        // var_dump($request);
        // echo '<pre>';
        echo '你要执行的'.$city.'不存在';
    }
    public function _empty(){
        echo '傻逼，你错上加错了';
    }
}

// // 更改默认的空控制器名
// 'empty_controller'      => 'MyError',