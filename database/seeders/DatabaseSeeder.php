<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\{
    Author,
    Book,
    User,
    Category
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'password' => Hash::make('12345678'),
        ]);

        User::factory(1)->create([
            'password' => Hash::make('12345678'),
            'type' => 'admin',
        ]);

        Author::factory(5)->create();

        Category::create([
            'name' => 'Religion',
            'description' => '---------',
        ]);

        Book::create([
            'name' => 'El Hobbit',
            'author_id' => 3,
            'category_id' => 1,
            'published' => new \Carbon\Carbon('1937-09-21'),
        ]);
    }
}
