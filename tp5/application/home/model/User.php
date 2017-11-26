<?php
namespace app\home\model;
use think\Model;

class User extends Model
{
    protected $table = "w_user";
    protected $resultSetType = 'collection';        //更改返回的结果集 
    protected $readonly = ['keyTime'];              //只读属性

    protected $type = [                                //自动转换类型
        
    ];

    //登陆用户
    public static function loginUser($phone,$password){
        
            $user = User::get(['phone'=>$phone]);
            if(!$user){
                return putError('用户不存在');
            }
            if($user->password == $password){
                $user->userKey = md5($phone.time());
                $result = $user->isUpdate(true)->save();
                if($result){
                    return putData(['phone'=>$phone,'key'=>$user->userKey,'userId'=>$user->userId],'登录成功');
                }else{
                    return putError('登录失败');
                }
            }else{
                return putError('密码错误');
            }
    }
    //验证key值
    public static function vertifierKey($key,$id,$keyEffectTime){
            $user = new User();
            $result = $user->where('userId',$id)->find();
            if(!$result){
                return false;
            }
            $createTime = strtotime($result->keyTime);
            $ifEffect = ($createTime + $keyEffectTime) > time() ? true : false;
            if($key == $result->userKey && $ifEffect){
                return true;
            }else{
                return  false;
            }
            
    }

    protected function scopePassword($query)
    {
        $query->where('password',md5('123456'));

    }
    protected function scopePhone($query)
    {
        $query->where('phone','15101082479')->find();
    }
    public function setNameAttr($value)
    {
        return strtolower($value);
    }
    public function getNameAttr($value)
    {
        return strtoupper($value);
    }
    //统一注册模型事件
    protected static function init()
    {
        //支持before_delete、after_delete、before_write、after_write、before_update、after_update、before_insert、after_insert事件行为
        // User::event('before_insert',function($user)
        // {
        //     return true;
        // });
        User::beforeInsert(function($user){
            return true;
        });
    } 

    //关联模型
    public function UserLession()
    {
        //一对一
    //    return $this->hasOne('UserLession','userId')->bind(['phone','lessName'=>'trueName',]);
        //一对多
        // return $this->hasMany('UserLession','userId');
        //远程一对多------hasManyThrough(‘关联模型名’,‘中间模型名’,‘外键名’,‘中间模型关联键名’,‘当前模型主键名’,[‘模型别名定义’]);
        // return $this->hasManyThrough('UserLession');
        // 多对多 belongsToMany(‘关联模型名’,‘中间表名’,‘外键名’,‘当前模型关联键名’,[‘模型别名定义’]);
        // return $this->belongsToMany('Role');

        // 多态一对多关联----morphMany(‘关联模型名’,‘多态字段信息’,‘多态类型’);
        // return $this->morphMany('Comment', 'commentable');
    }


}