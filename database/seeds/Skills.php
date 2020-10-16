<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;
use Faker\Factory as Faker;

class Skills extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); //create randome variables lika name,email etc
        for ($i = 0; $i < 10; $i++) {
            $array = [
                'name' => $faker->word,
            ];
            Skill::create($array);
        }
    }
}
