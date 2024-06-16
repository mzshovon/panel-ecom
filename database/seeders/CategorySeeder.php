<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Baby Item",
            ],
            [
                "name" => "Home Appliance",
            ],
            [
                "name" => "Gadgets",
            ],
            [
                "name" => "Beauty",
            ],
        ];

        collect($data)->map(function($value){
            Category::create($value);
        });
    }
}
