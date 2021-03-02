<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;
    protected $jobs = ['woker', 'teacher', 'student'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => App\Models\User::class,
            'name_picker' => [
                'result' => ["PHP", "Laravel", "MySQL", "VueJS", "JavaScript"],
                'item' => ["PHP", "Laravel", "MySQL", "VueJS", "JavaScript"],
            ],
            'custom_list' => [
                'item' => ["Laravel", "PHP", "VueJS", "MySQL", "JavaScript"]
            ],
        ];
    }
}
