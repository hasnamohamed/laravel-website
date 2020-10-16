<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Factory as Faker;

class Tags extends Seeder
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
            Tag::create($array);
        }
    }
}
