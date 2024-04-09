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

    public function hasPermissions(EnumUserPermission ...$permissions): bool
    {
        $q = $this->permissions();

        foreach ($permissions as $p) {
            $q->where("name", $p);
        }

        return $q->exists();
    }

    public function hasAnyPermission(EnumUserPermission ...$permissions): bool
    {
        $q = $this->permissions();

        for ($i = 0; $i < count($permissions); ++$i) {
            if ($i == 0) {
                $q->where("name", $permissions[$i]);
            } else {
                $q->orWhere("name", $permissions[$i]);
            }
        }

        return $q->exists();
    }
}
