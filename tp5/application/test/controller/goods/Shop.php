<?php
namespace app\test\controller\goods;
use think\Controller;
class Shop extends Controller
{
    public function index()
    {
    	$firstPage = controller('index/index','controller');
    	echo $firstPage->try();
    	// return $firstPage;

        // echo '我是shiop模块的index方法';
    }
}
