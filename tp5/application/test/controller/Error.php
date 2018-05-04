<?php
namespace app\test\controller;
use think\Request;
class Error
{
	public function index(Request $request){
		echo '页面出错了啊！！！！！';
	}
	public function _empty(){
		echo '页面不存在啊！！！！！';	
	}
}