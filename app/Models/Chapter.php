<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "series_id",
        "number",
        "title",
        "published",
        "release_date"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function publish()
    {
        if (!$this->update(["published" => true,])) {
            return;
        };

        $this->series()->update([
            "updated_at" => Carbon::now(),
        ]);
    }
}
