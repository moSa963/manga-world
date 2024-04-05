<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPermission>
 */
class UserPermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 0,
            "permission_id" => 0
        ];
    }


    public function configure()
    {
        return $this->afterMaking(function (UserPermission $userPermission) {
            if ($userPermission->user_id == 0) {
                $userPermission->user_id = User::factory()->create()->id;
            }

            if ($userPermission->permission_id == 0) {
                $userPermission->permission_id = Permission::factory()->create()->id;
            }
        });
    }
}
