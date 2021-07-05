<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    use HasFactory;

    protected $fillable = [
        'city_id',
        'title',
        'text',
        'rating',
        'user_id',
        'img',
    ];
}
