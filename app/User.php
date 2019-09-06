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
     * 一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * 我的关注
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'fans', 'user_id')->withTimestamps();
    }

    /**
     * 我的粉丝
     *
     * 点击关注，往user_id里面插入被关注者id，在fans插入我的id
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fans()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'fans')->withTimestamps();
    }

    /**
     * 查询指定用户是否是我的粉丝
     *
     * @param $uid
     * @return mixed
     */
    public function isFollow($uid)
    {
        return $this->fans()->wherePivot('fans', $uid)->first();
    }

    /**
     * 关注与取关
     *
     * @return array
     */
    public function followToggle($ids)
    {
        $ids = is_array($ids) ?: [$ids];
        return $this->fans()->toggle($ids);
    }
}
