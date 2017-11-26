<?php
namespace app\home\controller;
// use think\View;
use think\Controller;
class Index extends Controller
{
    //前置方法列表，only->只有这些使用，'except'->只有这些不使用
    protected $beforeActionList = [

        // 'first',
        // 'second' => ['except' => 'hello','only' => 'index'],
        // 'three' => ['only' => 'hello'],
        // 'vetifier' => ['only' => 'read'],
    ];
    // public function vetifier(){
    //     echo '我是vertifier方法';
    //     var_dump($_GET);
    //     if(!isset($_GET['id'])){

    //         $this->error('失败');

    //     }
    // }
    // public function second(){
    //     echo '我是second方法';
    // }
    // public function three(){
    //     echo '我是three方法';
    // }
    public function index()
    {
        
        echo '我是home模块';
        echo '<br/>';
        echo config('keyEffectTime');
    //     $view = new View();
    //    return $view->fetch('index');
    // return json(['data'=>'200']);    
    //   echo '我是home模块';

    // $this -> success('成功','home/index/read');
    // $this->error('新增失败');
    }
    public function hello(){
        echo '我是hello方法';
        if(isset($_GET['id']))
        $this->redirect('home/index/read',['id'=>'456','hello'=>'789'],302,['hello'=>'1111']);
    }
// 使用redirect助手函数还可以实现更多的功能，例如可以记住当前的URL后跳转

// redirect('News/category')->remember();
// 需要跳转到上次记住的URL的时候使用：

// redirect()->restore();
    public function read($id,$hello){
        // session_start();
        
        echo '我是read方法，'.'你输入了---'.$id.'----'.$hello.'<br />';
        // var_dump($_SESSION);

    }
    // public function initialize(){
    //     echo '我是init模块，你必须继承系统controller，每一次调用方法之前都先调用我';
    // }

//找不到指定方法执行
   public function _empty($name){

    return 'error'.$name;
    }
}
