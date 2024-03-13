<?php

namespace Database\Factories;

use App\Enums\ConservationStateEnum;
use App\Enums\GenreEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'conservation_state' => $this->faker->randomElement(['new', 'excellent', 'good', 'regular', 'worn', 'damaged', 'unusable']),
            'genre' => $this->faker->randomElement(['fiction', 'romance', 'suspense', 'horror', 'fantasy', 'science_fiction', 'drama', 'action', 'adventure', 'mystery', 'history', 'biography', 'self_help', 'poetry', 'short_story', 'chronicle', 'essay', 'educational', 'religion', 'cooking', 'comic_book', 'manga', 'children_literature']),
            'transaction_type' => $this->faker->randomElement(['donation', 'borrow', 'exchange']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
