<?php

namespace Database\Seeders;

use App\Models\Peran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                "nama_peran" => "Project Manager",
                "level" => 1
            ],
            [
                "nama_peran" => "Operator",
                "level" => 2
            ]
        ])->each(function ($role) {
            Peran::create($role);
        });
    }
}
