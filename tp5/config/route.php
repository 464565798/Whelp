<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;
// Route::get('/',function(){
//     echo 'Hello,world!';
// });
// Route::rule('index/index.people/index','test/index/index');
// Route::get('test/goods','test/index.test/index');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    // 'new/:cate'=> 'index/index',
    // '/' => 'test/index/index',
    '[hello]'     => [
        ':id'   => ['index/index', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/index', ['method' => 'post']],
    ],

];