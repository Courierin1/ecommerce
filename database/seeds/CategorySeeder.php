<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => "Earrings",
            'description' =>"<p><br></p>",
            'slug' => 'earrings',
            'image' => null,
            'status' => 1
        ]);

        Category::create([
            'name' => "Bracelets",
            'description' =>"<p><br></p>",
            'slug' => 'bracelets',
            'image' => null,
            'status' => 1
        ]);

        Category::create([
            'name' => "Necklaces",
            'description' =>"<p><br></p>",
            'slug' => 'necklaces',
            'image' => null,
            'status' => 1
        ]);
    }
}
