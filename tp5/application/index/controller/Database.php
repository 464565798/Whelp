<?php
namespace app\index\controller;
use app\home\model;
use think\Controller;
use traits\model\SoftDelete;
class Database extends Controller
{
    public function index()
    {
        return $this->fetch();
        return '我是dababase模块';
    }
    public function user()
    {
        $user = \app\home\model\User::get(['phone'=>'15101082479']);
        // //getData()-----获取原始数据
        // //toArray()-----获取包含修改器的所有内容
        // var_dump($user->toArray());
        // $user->delete();

        // $u = \app\home\model\User::withTrashed()->select();
        // var_dump($u);
        // echo $user;
        // $user = \app\home\model\User::get('11');
        echo '<pre>';
        // var_dump($user->password()->toArray());
        //hidden---隐藏   visible-允许   append-追加
        // var_dump($user->hidden(['phone','name'])->toArray());
        //   $lessArr = $user->UserLession; 
        // foreach($lessArr as $less)
        // {
        //   var_dump($less->toArray());
        // };
        // var_dump($user->UserLession()->where('lessId','1')->find());
        var_dump(\app\home\model\User::has('UserLession','>','1')->select());
        echo '</pre>';
        // echo $user->UserLession->lessName;
    }
    
}