<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        "series_id",
        "title",
        "published",
    ];

    public function series() {
        return $this->belongsTo(Series::class);
    }

    public function pages() {
        return $this->hasMany(Page::class);
    }
}
