<?php
namespace app\index\validate;
use think\validate;
class userValidate extends Validate
{
    protected $rule = [
        'name'=>'require|max:25',
        'phone'=>'require|max:11',
        'age'  => 'between:1,120|number',
        'email'=>'email',
    ];
    protected $message = [
        'name.max' => 'name长度太长',
        'phone.max' => 'phone不正确',
    ];
    protected function checkName($value,$rule,$data){
        return '年龄错误';
    }
    protected $scene = [
        'edit'  =>  ['name','age'],
    ];
}