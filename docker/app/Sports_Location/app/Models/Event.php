<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_image',
        'user_id',
        'genre_id',
        'area_id',
        'location',
        'date',
        'start_time',
        'end_time',
        'contents',
        'condition',
        'deadline',
        'number',
        'stuff',
        'attention',
        'status',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'event_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'event_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'event_id', 'id');
    }

    public function getFormattedDeadlineAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['deadline'])->format('Y年m月d日 H時i分');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->format('Y年m月d日');
    }

    public function getFormattedStartTimeAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->attributes['start_time'])->format('H時i分');
    }

    public function getFormattedEndTimeAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->attributes['end_time'])->format('H時i分');
    }
}
