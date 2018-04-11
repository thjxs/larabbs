<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Traits\ActiveUserHelper, Traits\LastActivedAtHelper;

    use Notifiable {
        notify as protected laravelNotify;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'introduction', 'avatar', 'weixin_openid', 'weixin_unionid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function setPasswordAttribute($password)
    {
        if (strlen($password) != 60) {
            $password = bcrypt($password);
        }
        $this->attributes['password'] = $password;
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function notify($instance)
    {
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * Gravatar 全球通用头像
     *
     * @return url
     */
    public function getAvatar($size = '100')
    {
        //$this->attributes['email']  获取用户的邮箱
        //trim 剔除空白内容
        $hash = md5(strtolower(trim($this->attributes['email'])));
        $avatar = $this->attributes['avatar'] ? : "http://www.gravatar.com/avatar/$hash?s=$size";
        return $avatar;
    }

    public function setAvatarAttribute($path)
    {
        if (! starts_with($path, 'http')) {
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
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
