<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'kana',
        'email',
        'tel',
        'birthday',
        'gender',
        'password',
        'profile_image',
        'introduction'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'relationships', 'followed_id', 'following_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'relationships', 'following_id', 'followed_id');
    }

    public function getFormattedBirthdayAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['birthday'])->format('Y年m月d日');
    }

    public function getGenderTextAttribute()
    {
        switch ($this->attributes['gender']) {
            case 'male':
                return "男性";
            case 'female':
                return "女性";
            case 'other':
                return "その他";
        }
    }
}
