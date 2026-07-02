<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = Category::factory(10)->create();

        foreach ($categories as $category) {
            Meal::factory(10)->create([
                'category_id' => $category->id,
            ]);
        }

        $this->call([
            SettingSeeder::class,
        ]);
    }
}
