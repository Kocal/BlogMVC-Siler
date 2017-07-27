<?php

use Illuminate\Support\Str;
use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
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

        $user = $this->fetchRow('SELECT id FROM user');
        $categories = $this->fetchAll('SELECT id FROM category');

        foreach ($categories as $category) {
            for($i = 0; $i < 5; $i++) {
                $name = $faker->sentence(random_int(5, 10));

                $this->insert('post', [
                    'user_id' => $user['id'],
                    'category_id' => $category['id'],
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'content' => $faker->realText(1000),
                    'created' => $faker->dateTime->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
