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

        $roles = Peran::get();

        $default_user_value = [
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];

        // get role
        $get_roles = Role::whereIn('name', $roles->pluck("nama_peran")->toArray())->get();
        // get users
        $get_users = User::get();
        foreach ($roles as $role) {

            $user_data = array_merge([
                'name' => 'Akun ' . $role->nama_peran,
                'username' => strtolower(str_replace(' ', '_', $role->nama_peran)),
            ], $default_user_value);

            // check roles exists
            $role_exists = $get_roles->where("name", $role->nama_peran)->first();
            if (empty($role_exists)) {
                $role = Role::create(['name' => $role->nama_peran]);
            }
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
