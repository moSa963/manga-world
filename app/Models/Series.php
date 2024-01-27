<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "painter",
        "author",
        "other_names",
        "type",
        "status",
        "release_year",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
