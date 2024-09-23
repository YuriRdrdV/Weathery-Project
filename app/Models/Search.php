<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'country',
        'region',
        'localtime',
        'temperature',
        'feelslike',
        'weather',
        'icon',
        'wind_speed',
        'humidity',
        'precip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
