<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cartitems';

    protected $fillable = [
        'user_id',
        'watch_id',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function watch()
    {
        return $this->belongsTo(\App\Models\Watch::class, 'watch_id');
    }
}