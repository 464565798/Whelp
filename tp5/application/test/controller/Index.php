<?php
namespace app\test\controller;
use \think\Db;
use \app\test\model;
class Index extends \think\Controller
{
    public function index()
    {
        // echo config('?hehe.error_text') ? "存在" : "不存在";
        // $request = $this->request;
        // echo '<pre>';
        // var_dump($request);
        // echo '</pre>';
        // \think\Request::hook('user','verfierUser');
        // echo config('hostname');
        // return request()->user('456');
        // return putData(['123'=>"234"],'123');
        // $db = \think\Db::table('user_lession');
        // $data = [
        //     ['lessState'=>'2','userId'=>'15','lessName'=>'php教程','lessUrl'=>'http://www.google.cn'],
        //     ['lessState'=>'2','userId'=>'13','lessName'=>'java教程','lessUrl'=>'http://www.google.cn']
        // ];
        // $result = $db->insertAll($data);
        // if($result){
        //     echo '插入成功';
        // }else{
        //     echo '插入失败';
        // }
        // $result = $db->where('lessId>2')->delete(); 
        // var_dump($db->query('select * from user_lession'));
        // echo '<pre>';
        // var_dump($db->alias('a')->join('W_user b','a.lessId = b.userId')->field('b.name,b.phone,a.lessName')->select());
        // echo '</pre>';
        //  if($result){
        //     echo '插入成功';
        // }else{
        //     echo '插入失败';
        // }
        // var_dump(db('user_lession')->cache(true,5)->select());
        // $result = db("user_lession")->strict(true)->insert(['id'=>'hehe' ,'lessState'=>'2','userId'=>'15','lessName'=>'php教程','lessUrl'=>'http://www.google.cn']);
       
    //    $result = db('user_lession')->where('lessId = 9')->selectOrFail();
       
        // if($result){
        //     echo '插入成功';
        // }else{
        //     echo '插入失败';
        // }
        // $id = 8;
        // \think\Db\Query::event('before_select',function($options,$query){
        //     // 事件处理
        //     var_dump($options);
        //     // echo $query;
        // });
        // $result = \think\Db::query('select * from user_lession where lessId=?',[$id]);
        
        // $result = db('user_lession')->where('lessId','=',$id)->select();
        // Db::startTrans();
        // try{
        //     $result = Db::table('user_lession')->insert(['lessId'=>19,'lessState'=>2,'userId'=>12,'lessName'=>'成功了','lessUrl'=>'http:?/www.']);
        //     $deleteResult = Db::table('user_lession')->delete(1);
        //     Db::commit();   
        // }catch(\Exception $e){
        //     Db::rollback();
        //     echo 'fail';
        // }
        // var_dump($result);

        // $user = \app\test\model\User::get(2);
        // $user = model('User');
        // $user = $user->get(['lessId'=>2]);
        // $user->lessName = 'SinasPores';
        // $result = $user->save();
        // if($user){
        //     echo '成功';
        // }else{
        //     echo '失败';
        // }
        // echo $user->lessUrl;

        // $list = \app\test\model\User::getStateDataWithUser(2);
        // echo '<pre>';
        // var_dump($list[0]->getData());
        // // echo $list[0]->lessState;
        // echo '</pre>';
        // $user = model('User')->get(2);
        // $user->lessName = 'java lession2';
        // $user->lessState = '55';
        // $user->save();
        // echo strtotime($user->lessTime);


        // $user = model('user','service');
        // $list = $user->select();
        // foreach($list as $value){
        //     echo '<pre>';
        //     var_dump($value->visible(['userId'])->toArray());
        //     echo '</pre>';
        // }
        // $user = model('User')->get(19);
        // var_dump($user->user_type);
        // echo $user->UserType->name;

        $userType = model('userType')->get(5);
        // var_dump( $userType->user);
        $userType->user->lessUrl = 'http://www.google.coms';
        $userType->name = '我心飞扬了';
        $result = $userType->together('user')->save();
        if($result){
            echo '成功';
        }else{
            echo '失败';
        }
    }
}
