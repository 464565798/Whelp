<?php
namespace app\test\model;

use think\Model;

class UserType extends Model
{
    protected $table = 'w_user';
    public function user(){
        return $this->belongsTo('User','userId','lessState');
    }
}