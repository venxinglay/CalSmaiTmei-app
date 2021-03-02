<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Model;
use App\Models\Randomzier;
use Illuminate\Database\Eloquent\Factories\Factory;

class RandomizerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Randomzier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => User::factory(),
            'name_picker' => $this->faker->randomElement(['open', 'partial', 'processed', 'updating']),
            'custom_list' => $this->faker->randomElement(['this', 'who', 'hi', 'what']),
            'team_generator' => $this->faker->randomElement(['when', 'how', 'who i am', 'updating']),
            'decision_maker' => $this->faker->randomElement(['opensdsf', 'partialasdfsad', 'processeddsfdsf', 'updatingdfsdwwwww']),
            'random_picker' => $this->faker->randomElement(['opensdfsadf', 'partialdfasdfasdf', 'processedkkkkk', 'asdfasdfupdating']),
            'yes_no' => $this->faker->randomElement(['openwerewr', 'partialasdfasdf', 'processedwwerere', 'updatingdekkkkkk']),
        ];
    }
}
