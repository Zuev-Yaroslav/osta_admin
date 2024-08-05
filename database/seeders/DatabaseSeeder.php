<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Application;
use App\Models\Building;
use App\Models\BuildingImage;
use App\Models\Development;
use App\Models\Event;
use App\Models\History;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
         User::create([
             'email' => 'osta@osta.ru',
             'name' => 'osta',
             'username' => 'osta_admin',
             'password' => Hash::make(env('USER_PASSWORD', 12345678))
         ]);
        $user = User::find(1);
        $user->update(['password' => Hash::make(env('USER_PASSWORD'))]);
         Development::insert([
             [
                 'name_ru' => 'эскиз/фор-эскиз',
                 'name_tt' => 'эскиз/фор-эскиз',
             ],
             [
                 'name_ru' => 'построено',
                 'name_tt' => 'төзелгән',
             ],
         ]);
         History::create([
             'title_ru' => 'aaaaaaaa',
             'title_tt' => 'sssssssssss',
             'text_ru' => 'aaaaaaaa',
             'text_tt' => 'sssssssssss',
         ]);
         $this->call(TestSeeder::class);
    }
}
