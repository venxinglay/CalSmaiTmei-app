<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $user = User::factory(5)
            ->has(Post::factory()->count(1), 'posts')
            ->create();
        // DB::table('posts')->insert([
        //     'name_picker' => [ // Do not json_encode this as your model will handle the conversion
        //         "result" => $this->faker->randomElements(["PHP", "Laravel", "MySQL", "VueJS", "JavaScript"], rand(2, 4)),
        //     ],
        //     'custom_list' => [ // Do not json_encode this as your model will handle the conversion
        //         "result" => $this->faker->randomElements([
        //             "PHP", "Laravel", "MySQL", "VueJS", "JavaScript"
        //         ], rand(2, 4)),
        //     ],
        // ]);
    }
}
