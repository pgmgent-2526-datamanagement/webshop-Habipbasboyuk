<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;
    
    protected $table = 'watches';
    
    protected $fillable = [
        'name',
        'brand', 
        'price',
        'short_description',
        'isautomatic',
        'image'
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\Image::class, 'watch_id');
    }
}