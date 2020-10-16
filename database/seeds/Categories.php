<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class Categories extends Seeder
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
                'meta_keywords' => $faker->name,
                'meta_des' => $faker->name,
            ];
            Category::create($array);
        }
    }
}
