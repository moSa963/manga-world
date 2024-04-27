<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserPermission as EnumUserPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function series()
    {
        return $this->hasMany(Series::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, UserPermission::class);
    }

    public function hasPermissions(EnumUserPermission | string ...$permissions): bool
    {
        foreach ($permissions as $p) {
            if (!$this->permissions()->where("name", $p)->exists()) {
                return false;
            }
        }

        return true;
    }

    public function hasAnyPermission(EnumUserPermission ...$permissions): bool
    {
        foreach ($permissions as $p) {
            if ($this->permissions()->where("name", $p)->exists()) {
                return true;
            }
        }

        return false;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function addPermission(EnumUserPermission $permission)
    {
        UserPermission::firstOrCreate([
            "user_id" => $this->id,
            "permission_id" => Permission::id($permission),
        ]);
    }

    public function deletePermission(EnumUserPermission $permission)
    {
        UserPermission::where("user_id", $this->id)->where("permission_id", Permission::id($permission))->delete();
    }
}
