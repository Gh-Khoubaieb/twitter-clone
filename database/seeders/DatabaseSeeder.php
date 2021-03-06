<?php

namespace Database\Seeders;

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
        /* Creation de 5 fake tweet pour chaque utilisateur */

         \App\Models\User::factory(10)->create()->each(
            function ($user) {
                $user->tweets()->saveMany(\App\Models\Tweet::factory(5)->make());
              //  fn ($user) => $user->tweets()->saveMany(\App\Models\Tweet::factory(5)->make())
            }
         );
    }
}
