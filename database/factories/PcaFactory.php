<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pca>
 */
class PcaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pca_id'=>$this->faker->values(['3101010',
                                                        '3101020',
                                                        '3171010',
                                                        '3171020',
                                                        '3172010',
                                                        '3172020',
                                                        '3172030',
                                                        '3172040',
                                                        '3173010',
                                                        '3173020',
                                                        '3173030',
                                                        '3173040',
                                                        '3174010',
                                                        '3174020',
                                                        '3174030',
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
