<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{

    protected $model = Products::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->model::factory(50)->create();
    }
}