<?php
namespace app\home\controller;
use think\Request;
class Admin
{
    public function index(){
        // \think\Loader::controller('Blog', 'event');
        // controller('home/index','controller');
        // $top = controller('home/index','controller');
        // $top->read(3,4);

        // echo action('index/read',['id'=>'123','hello'=>'890'],'controller');


        $request = Request::instance();   //request();
        //当前域名
        echo 'domain: '.$request->domain().'<br />';
        //当前入口文件
        echo 'file: '.$request->baseFile().'<br />';
        //获取当前URL地址 不含域名
        echo 'url: '.$request->url().'<br />';
         //获取包含域名的整体url
         echo 'url with domain: '.$request->url(true).'<br/>';
         // 获取当前URL地址 不含QUERY_STRING
         echo 'url without query: ' . $request->baseUrl() . '<br/>';
         // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';

        echo "当前模块名称是" . $request->module().'<br/>';
        echo "当前控制器名称是" . $request->controller().'<br/>';
        echo "当前操作名称是" . $request->action().'<br/>';
        $request->param('&ppp=4&asd=8');
        echo '请求参数：'; 
        dump($request->param());
        echo '请求参数：';
        dump($request->only(['id','name'])); 
        echo '请求参数：';
        dump($request->except(['name'])); 


        echo '路由信息：';
        dump($request->route());
        echo '调度信息：';
        dump($request->dispatch());
    }


}

