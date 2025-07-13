<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = [
            ['name' => 'Dhaka Division', 'district' => 'Dhaka'],
            ['name' => 'Chittagong Division', 'district' => 'Chittagong'],
            ['name' => 'Rajshahi Division', 'district' => 'Rajshahi'],
            ['name' => 'Khulna Division', 'district' => 'Khulna'],
            ['name' => 'Barisal Division', 'district' => 'Barisal'],
            ['name' => 'Sylhet Division', 'district' => 'Sylhet'],
            ['name' => 'Rangpur Division', 'district' => 'Rangpur'],
            ['name' => 'Mymensingh Division', 'district' => 'Mymensingh'],
            ['name' => 'All Divisions', 'district' => null],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
