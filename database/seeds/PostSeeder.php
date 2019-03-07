<?php

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

        foreach (User::all() as $user) {
            foreach (Category::all() as $category) {
                for ($i = 0; $i < 5; $i++) {
                    $name = $faker->sentence(random_int(5, 10));

                    Post::create([
                        'user_id' => $user->id,
                        'category_id' => $category->id,
                        'name' => $name,
                        'slug' => Str::slug($name),
                        'content' => $faker->realText(1000),
                        'created' => $faker->dateTime->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
