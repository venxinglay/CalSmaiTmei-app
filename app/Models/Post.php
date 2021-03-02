<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = [
        'type',
        'data',
        'user_id'
    ];


    protected $casts = [
        'type' => 'integer',
        'qty' => 'integer',
        'data' => 'array',
        'items' => 'array',
        'result' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
