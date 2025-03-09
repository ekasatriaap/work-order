<?php

namespace Database\Seeders;

use App\Models\Peran;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\UserRoles;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $roles = Role::get();

        $default_user_value = [
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
        // get users
        $get_users = User::get();
        foreach ($roles as $role) {
            $user_data = array_merge([
                'name' => 'Akun ' . $role->name,
                'username' => strtolower(str_replace(' ', '_', $role->name)),
                "id_role" => $role->id
            ], $default_user_value);

            // check user exists
            $user_exists = $get_users->where("username", $user_data['username'])->first();
            if (empty($user_exists)) {
                $user = User::create($user_data)->assignRole($role);

                UserRoles::create(
                    [
                        'id_user' => $user->id,
                        'id_role' => $role->id,
                    ]
                );
            }
        }

        $menus = getMenu();
        $permissions = [];

        foreach ($menus as $k => $menu) {
            $permissions = array_merge($permissions, getAllPermissionMenu($menu));
        }

        // get data from permission table
        $get_permissions = Permission::get();

        foreach ($permissions as $permission) {
            // check param exists
            $permission_exists = $get_permissions->where('name', $permission)->first();
            if ($permission_exists) continue;
            Permission::create(['name' => $permission]);
        }
    }
}
