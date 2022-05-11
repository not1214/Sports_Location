<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'permission',
        'comment',
        'reply',
    ];

    const PERMISSION = [
        1 => '未承認',
        2 => '承認',
        3 => '棄却',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPermissionTextAttribute()
    {
        switch ($this->attributes['permission']) {
            case 1:
                return "未承認";
            case 2:
                return "承認";
            case 3:
                return "棄却";
        }
    }
}
