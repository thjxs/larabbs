<?php

namespace App;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Gravatar 全球通用头像
     *
     * @return url
     */
    public function gravatar($size = '100')
    {
        //$this->attributes['email']  获取用户的邮箱
        //trim 剔除空白内容
        $hash = md5(strtolower(trim($this->attributes['email'])));
        $gravatar = $this->attributes['gravatar'] ? : "http://www.gravatar.com/avatar/$hash?s=$size";
        return $gravatar;
    }
}
