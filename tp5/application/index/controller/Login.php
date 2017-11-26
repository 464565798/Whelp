<?php
namespace app\index\controller;
use think\Controller;
class Login extends Controller
{
    public function index()
    {
        // var_dump($_REQUEST);
        // die();
        if(!vertifierParam($_REQUEST,['phone','password','vertifierCode'])){
            // $this->fetch('index/index/index');
            $this->redirect('index/login?error=请填写完整信息');
        }
            $phone = $_REQUEST['phone'];
            $password = md5($_REQUEST['password']);
            // echo $phone;
            $data = \app\home\model\User::loginUser($phone,$password);

            $result = json_decode($data->getContent());
            // var_dump($result);
            // die();
            if($result->code == 200){
                $key = $result->result->key;
                //保存用户信息到session
                session('userKey',$key);
                session('phone',$result->result->phone);
                session('userId',$result->result->userId);
                //保存个别信息到cookie
                if(cookie('phone')==$phone){
                    cookie('lastLogin',cookie('loginTime'));
                }else{
                    cookie('phone',$phone);
                    cookie('lastLogin',null);
                }
  
                cookie('loginTime',date('y-m-d h:i:s',time()));

                $this->redirect('index/index');
            }else{

                $this->redirect('index/login?error='.$result->message);
            }
    }
    public function unlogin()
    {
        session(null);
        // echo '123';
        $this->redirect('index/index');
    }
}
