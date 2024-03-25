<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoria = \App\Models\Categoria::inRandomOrder()->first(); // Obtener una categoría existente de manera aleatoria

        return [
            'name' => $this->faker->word(),
            'cantidad' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'categoria_id' => $categoria->id, // Asignar el ID de la categoría existente
        ];
    }
}
