<?php
namespace app\test\model;

use think\Model;

class User extends Model
{
    // protected $type = [
    //     'lessId'=>'integer',
    //     'lessName'=> 'float',
    //     'lessTime'=>'datetime',
    // ];
    protected $table = 'user_lession';
    // protected $readonly = ['lessId','lessName'];
    // public static function getStateDataWithUser($state){
    //     $user = new User();
    //     $list = $user->all(['lessState'=>$state]);
    //     return $list; 
    // }
    // public function getlessStateAttr($value){
    //     $status = [1=>'正常',2=>'正在授课',3=>'已完结'];
    //     return $status[$value];
    // } 
    public function userType(){
        //userId -------  关联表字段    lessState--------主表关联字段
        return $this->hasOne('UserType','userId','lessState');
    }
}