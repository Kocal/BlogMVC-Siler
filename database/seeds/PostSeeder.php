<?php

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

        $user = $this->fetchRow('SELECT id FROM users');
        $categories = $this->fetchAll('SELECT id FROM categories');

        foreach ($categories as $category) {
            for($i = 0; $i < 5; $i++) {
                $this->insert('posts', [
                    'user_id' => $user['id'],
                    'category_id' => $category['id'],
                    'name' => $faker->name,
                    'slug' => $faker->slug,
                    'content' => $faker->text,
                    'created' => $faker->dateTime->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
