<?php

namespace App\Models;

use App\Enums\UserPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public $table = "permissions";

    protected $fillable = [
        "name",
    ];

    public static function id(UserPermission $permission): int | null
    {
        return Permission::where("name", $permission)->first()?->id;
    }
}
