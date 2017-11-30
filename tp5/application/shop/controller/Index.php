<?php
namespace app\shop\controller;
// use think\View;
use think\Controller;
class Index extends Controller
{
    public function Index(){
       return $this->fetch();
    }
}
