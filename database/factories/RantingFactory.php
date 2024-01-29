<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ranting>
 */
class RantingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pca_id'=>$this->faker->values(['1',
                                                        '1',
                                                        '1',
                                                        '2',
                                                        '2',
                                                        '2',
                                                        '3',
                                                        '3',
                                                        '3',
                                                        '4',
                                                        '4',
                                                        '4',
                                                        '5',
                                                        '5',
                                                        '5  ',
                                                        '3174040',
                                                        '3175010',
                                                        '3175020',
                                                        '3175030',
                                                        '3175040',
                                                    ]),
            'pda_id'=>$this->faker->randomElement(['1', '2','3','4','5']),
            'pca_name'=>$this->faker->state(),
            'address'=>$this->faker->address(),
            'created_by'=>'admin'
        ];
    }
}
