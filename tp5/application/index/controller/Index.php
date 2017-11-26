<?php
namespace app\index\controller;
use think\Controller;
// use app\index\validate;
use app\home\model\User;
class Index extends Controller
{

    //登录
    public function login($error='')
    {   
        // $error = '';
        // if(isset($_REQUEST['error']))
        // $error = $_REQUEST['error'];
        $this->assign([
            'error'=>$error,
        ]);
        // echo $error;
        return $this->fetch();
    }
    //注册
    public function resiger($error='')
    {
        $this->assign([
            'error'=>$error,
        ]);
        return $this->fetch();
    }

    //首页
    public function index()
    {
        // var_dump($_REQUEST);
        // $this->assign('name','ThinkPHP');
        // $this->assign('email','thinkphp@qq.com');
        
        // $list = User::where('userId','>','0')->paginate(1,true);
        // $page = $list->render();
        // $this->assign([
        //     'time'=>time(),
        //     'list'=>$list,
        //     'page'=>$page,
        //             ]);
        // var_dump($list);
        // echo $page;
        // var_dump($page);
        // echo APP_PATH.request()->module().'header.html';

        $phone=session('phone');
        $lastLoginTime = cookie('lastLogin');

        //赋值
        if($phone != '')
        $this->assign('phone',$phone);
        if($lastLoginTime != '')
        $this->assign('lastLoginTime',$lastLoginTime);
    
        return $this->fetch();
        // return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function tryVolist()
    {
        // $user = \app\home\model\User::all();
        // $this->assign([
        //     'user'=>$user,
        //     'phone'=>'15101082479',
        
        // ]);
        // return $this->fetch();

        // $userVali = new \app\index\validate\UserValidate();
        $data = ['name'=>'呵呵','phone'=>'15101082479','email'=>'12345@sina.cn','age'=>120];
        // $result = $userVali->check($data);
        // if($result){
        //     echo '正确';
        // }else{
        // echo $userVali->getError();
        // }
        $aaa = \think\Validate::is('15101082479','number');
        if($aaa){
            die('yes');
        }else{
            die('no');
        }
        $result = $this->validate($data,'UserValidate');
         if($result === true){
            echo '正确';
        }else{
        echo $result;
        }
    }
    public function cacheTry()
    {
    //    $result = \think\Cache::set('name','你猜猜我是谁',3600);
    //    echo $result;
    //    dump(\think\Cache::get('name'));

    // $result = \think\Session::set('name','thinkphp');
    // echo $result;
    dump(\think\Session::get('name'));

    // \think\Session::flash('name',['0'=>'123']);
    // dump(\think\Session::get('name.0'));
    // session('name','think');
    // dump(session('name'));

    }
    //上传文件
    public function upload()
    {

            // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('image');
    // 移动到框架应用根目录/public/uploads/ 目录下
    // $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads')
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    // $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        echo $info->getExtension();
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        echo $info->getSaveName();
        // 输出 42a79759f284b767dfcb2a0197904287.jpg
        echo $info->getFilename(); 
    }else{
        // 上传失败获取错误信息
        echo $file->getError();
    }
    }
}
