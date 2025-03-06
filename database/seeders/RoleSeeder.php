<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                "name" => "Project Manager",
                "level" => 1
            ],
            [
                "name" => "Operator",
                "level" => 2
            ]
        ])->each(function ($role) {
            Role::create($role);
        });
    }
}
