<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->count(3)->create();
        User::factory()->count(1)->create([
            'name' => 'root',
            'email' => 'root@example.org',
            'username' => 'root',
            'password' => Hash::make('root'),
        ]);
        Category::factory()->count(1)->create();
        Category::factory()->count(1)->create([
            'name' => 'book'
        ]);
        Category::factory()->count(1)->create([
            'name' => 'quote'
        ]);
        Content::factory()->count(1)->create([
            'category_id' => 1,
            'title' => 'Reject Degeneracy & Embrace God.',
            'author' => 'Hamza',
            'tag_time' => "11:11",
            'subtitle' => 'L\'exemple d\'un subtitle...',
            'link' => 'https://www.youtube.com/watch?v=-QdoEt_Qdxo',
        ]);
        Content::factory()->count(1)->create([
            'category_id' => 2,
            'title' => 'Platon oeuvres complètes',
            'tag_page' => 111,
            'author' => 'Platon',
        ]);
        Content::factory()->count(1)->create([
            'category_id' => 3,
            'quote' => '"Je sais que je ne sais rien."',
            'author' => 'Socrate',
            'book_id' => 3,
        ]);
    }
}
