<?php
namespace app\home\controller;
use think\Controller;
use app\home\model;
class User extends Controller
{
    public function index(){
        echo "我是User模块";
    }
    //注册用户
    public function resigerUser(){
        if(!vertifierParam($_REQUEST,['vertifier','phone','password'])){
            return json(['code'=>200,'data'=>'','message'=>'验证码错误']);
        }
//验证验证码 
            
            $phone = $_GET['phone'];
            $password = $_GET['password'];
            if(strlen($phone) != 11 || strlen($password) > 16 || strlen($password) < 6){

                return putError('数据格式不正确');

            }
            $user = \app\home\model\User::get(['phone' => $phone]);
            if($user){
                return putError('用户已存在');
            }
            $date = time();
            $key = md5($phone.$date);
            $data = ['phone' => $phone,'userKey'=> $key,'password'=>md5($password)];
            if($this->addUser($data)){
                return putData(['phone'=>$phone],'注册成功');
            }else{
                return putError('注册失败');
            }

    }
    //登陆用户
    public function loginUser(){
            if(!vertifierParam($_REQUEST,['phone','password'])){
                return putError('请求错误');
            }
            $phone = $_REQUEST['phone'];
            $password = md5($_REQUEST['password']);
            return \app\home\model\User::loginUser($phone,$password);
    }
    //验证key值
    public function vertifierKey(){
             if(!vertifierParam($_REQUEST,['key','userId'])){
                return putError('请求错误');
            }
            $key = $_REQUEST['key'];
            $id = $_REQUEST['userId'];
            $keyEffectTime = config('keyEffectTime');
            $result = \app\home\model\User::vertifierKey($key,$id,$keyEffectTime);
            if($result){
                return 'success';
            }else{
                return 'fail';
            }          
    }
    //获取验证码
    public function getCode($phone)
    {
            $vertifier = model("Vertifier");
            $result = $vertifier->where('phone',$phone)->find();
            if($result){
                $ifSuccess = \app\home\model\Vertifier::update(['phone'=>$phone,'code'=>$this->sendCode($phone)]);
                if($ifSuccess){
                    return '获取成功';
                }
                    return '获取失败';
            }
            $vertifier->phone = $phone;
            $vertifier->code = $this->sendCode($phone);
            $ifSuccess = $vertifier->allowField(true)->isUpdate(false)->save();
                if($ifSuccess){
                    return '获取成功';
                }
                    return '获取失败';

    } 
    private function sendCode($phone)
    {
        //发送验证码
        return '123456';
    }
    //验证验证码
    public function vertifierCode($phone,$code){
            $vertifier = model("Vertifier");
            $result = $vertifier->where('phone',$phone)->find();
            if(!$result)
            {
                return false;
            }
            $ifEffect = (strtotime($result->effect)+config('vertifierTime')) > time() ? true : false;
            if($code == $result->code && $ifEffect)
            {
                return true;
            }else
            {
                return false;
            }
    }
    //添加用户
    private function addUser($data){

            $u = model('User');
            $u->data($data);
            $result = $u->save();
            return $result;
    }   
}