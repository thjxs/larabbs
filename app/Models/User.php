<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Gravatar 全球通用头像
     *
     * @return url
     */
    public function avatar($size = '100')
    {
        //$this->attributes['email']  获取用户的邮箱
        //trim 剔除空白内容
        $hash = md5(strtolower(trim($this->attributes['email'])));
        $avatar = $this->attributes['avatar'] ? : "http://www.gravatar.com/avatar/$hash?s=$size";
        return $avatar;
    }

    /*
    * auth operaton
    *
    */
    public function isAuthOf($model)
    {
        return $this->id === $model->user_id;
    }
}
