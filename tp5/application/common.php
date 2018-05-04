<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//忽略错误提示
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
\think\Lang::setAllowLangList(['zh-cn','en-us']);
use think\Request;
function putError($message){

    return json(['code'=>400,'message'=>$message,'result'=>[]]);
}
function putData($data,$message){
    return json(['code'=>200,'message'=>$message,'result'=>$data]);
}
function vertifierParam($param,$vertifier){
    foreach($vertifier as $str){
        if(!isset($param[$str])){
            return false; 
        }
    }
    return true;
}
function verfierUser(Request $request,$userId){
	return $userId;
}
