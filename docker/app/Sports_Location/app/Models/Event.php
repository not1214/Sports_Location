<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_image',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
