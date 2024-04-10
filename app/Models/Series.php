<?php

namespace App\Models;

use App\Enums\UserPermission;
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
        "release_date",
        "published",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    static public function for(?User $user)
    {
        if ($user == null) {
            return Series::where("published", true);
        }

        return Series::where("series.published", true)
            ->orWhere("users.admin", true)
            ->orWhere("series.user_id", $user->id)
            ->orWhere("permissions.name", UserPermission::APPROVE)
            ->join("users", "users.id", "=", $user->id)
            ->leftJoin("user_permission", "user_permission.user_id", "=", "users.id")
            ->leftJoin("permissions", "permissions.id", "=", "user_permission.permission_id");
    }
}
