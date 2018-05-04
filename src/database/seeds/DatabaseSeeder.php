<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Place::truncate();
        App\User::truncate();

        factory(App\User::class, 20)->create()->each(function($user){
            $user->places()->saveMany(factory(App\Place::class, 10)->make());
        });

        $users = App\User::all();

        foreach($users as $user) {
            $places = App\Place::all()->random(rand(5,10));

            foreach($places as $place) {
                $user->votes()->saveMany(factory(App\Vote::class, 1)->make(['place_id'=>$place->id]));
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
