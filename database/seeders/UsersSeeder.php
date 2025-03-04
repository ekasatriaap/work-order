<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Root',
                "email" => "ekasatria.ariaputra@gmail.com",
                "username" => "root",
                "password" => bcrypt("root"),
                "is_root" => true
            ],
        ])->each(function ($user) {
            User::create($user);
        });
    }
}
