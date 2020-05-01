<?php

namespace App\Models;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use HasApiTokens;
    use Traits\ActiveUserHelper;
    use Traits\LastActivedAtHelper;
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
     * Gravatar 全球通用头像.
     *
     * @return url
     */
    public function getAvatarAttribute()
    {
        //$this->attributes['email']  获取用户的邮箱
        //trim 剔除空白内容
        $hash = md5(strtolower(trim($this->attributes['email'])));
        $avatar = $this->attributes['avatar'] ?: "http://www.gravatar.com/avatar/$hash?s=300";

        return $avatar;
    }

    public function setAvatarAttribute($path)
    {
        if (!starts_with($path, 'http')) {
            $path = config('app.url')."/uploads/images/avatars/$path";
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function findForPassport($username)
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ? $credentials['email'] = $username :
            $credentials['phone'] = $username;

        return self::where($credentials)->first();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
