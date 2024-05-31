<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis_kelamin = ['Pria', 'Wanita'];
        $status_penghuni = ['Sudah Menikah', 'Belum Menikah'];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // default password
            'umur' => $this->faker->numberBetween(20, 50),
            'jenis_kelamin' => $jenis_kelamin[rand(0, 1)],
            'status_penghuni' => $status_penghuni[rand(0, 1)],
            'gambar_ktp' => $this->faker->imageUrl(),
            'role_id' => Role::find(2)->id, // Tetapkan role_id menjadi id dari Role yang bernilai 2
            'remember_token' => Str::random(10),
        ];
        
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
