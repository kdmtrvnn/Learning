<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
