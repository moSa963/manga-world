<?php

namespace App\Models;

use App\Enums\UserPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function allChapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function chapters()
    {
        if (!Auth::check()) {
            return $this->hasMany(Chapter::class)->where('published', true);
        }

        $user = Auth::user();
        return $this->hasMany(Chapter::class)
            ->where(function ($q) use ($user) {
                return $q->where('published', true)
                    ->orWhereHas('user', function ($query) use ($user) {
                        $query->where('users.id', $user->id)
                            ->orWhere('users.admin', true)
                            ->orWhereHas('permissions', function ($q) {
                                $q->where('permissions.name', UserPermission::APPROVE);
                            });
                    });
            });
    }

    static public function for(?User $user)
    {
        if ($user == null) {
            return Series::where("published", true);
        }

        return Series::select("series.*")
            ->where(function ($q) use ($user) {
                $q->where("series.published", true)
                    ->orWhere("series.user_id", $user->id)
                    ->orWhere("users.admin", true)
                    ->orWhere("permissions.name", UserPermission::APPROVE);
            })
            ->join("users", "users.id", "=", DB::raw($user->id))
            ->leftJoin("user_permission", "user_permission.user_id", "=", "users.id")
            ->leftJoin("permissions", "permissions.id", "=", "user_permission.permission_id")
            ->groupBy(
                "series.id",
                "series.user_id",
                "series.title",
                "series.description",
                "series.painter",
                "series.author",
                "series.other_names",
                "series.type",
                "series.status",
                "series.release_date",
                "series.published",
                "series.genres",
                "series.created_at",
                "series.updated_at",
            );
    }
}
