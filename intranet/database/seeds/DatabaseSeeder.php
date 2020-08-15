<?php

use App\LessonType;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@example.com',
        ]);

         $this->call(LessonTypeSeeder::class);

    }
}
