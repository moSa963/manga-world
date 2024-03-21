<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        "series_id",
        "number",
        "title",
        "published",
        "release_date"
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function next(): Chapter | null
    {
        return Chapter::where("series_id", $this->series_id)->where("number", ">", $this->number)->first();
    }

    public function prev(): Chapter | null
    {
        return Chapter::where("series_id", $this->series_id)->where("number", "<", $this->number)->orderBy("number", "desc")->first();
    }
}
