<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'disk' => 'public',
            'path' => UploadedFile::fake()->create($this->faker->name.'.png', 10, 'application/pdf')->store('/uploads', ['disk' => 'public']),
        ];
    }
}
