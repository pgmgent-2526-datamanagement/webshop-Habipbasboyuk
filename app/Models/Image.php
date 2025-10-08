<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'watch_id',
        'filename',
        'alt',
    ];

    public function watch()
    {
        return $this->belongsTo(Watch::class, 'watch_id');
    }
}