<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "small",
                "type" => "size",
            ],
            [
                "name" => "medium",
                "type" => "size",
            ],
            [
                "name" => "large",
                "type" => "size",
            ],
            [
                "name" => "extra large",
                "type" => "size",
            ],
            [
                "name" => "red",
                "type" => "color",
            ],
            [
                "name" => "blue",
                "type" => "color",
            ],
            [
                "name" => "purple",
                "type" => "color",
            ],
            [
                "name" => "white",
                "type" => "color",
            ],
            [
                "name" => "green",
                "type" => "color",
            ],
            [
                "name" => "premium",
                "type" => "quality",
            ],
            [
                "name" => "exclusive",
                "type" => "quality",
            ],
        ];

        collect($data)->map(function($value){
            Variant::create($value);
        });
    }
}
