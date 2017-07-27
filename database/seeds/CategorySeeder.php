<?php

use Illuminate\Support\Str;
use Phinx\Seed\AbstractSeed;

class CategorySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $name = $faker->sentence(2);

            $this->insert('category', [
                'name' => $name,
                'slug' => Str::slug($name),
                'post_count' => 5,
            ]);
        }
    }
}
