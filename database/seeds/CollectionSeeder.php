<?php

use Illuminate\Database\Seeder;
use App\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::create([
            'name' => "Preview Kit",
            'description' =>"<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</strong></p><p><br></p><p><strong>Includes:</strong></p><ul><li><strong><em>14 Earrings</em></strong></li></ul>",
            'slug' => 'preview-kit',
            'regular_price' => '44.44',
            'sale_price' => '44.44',
            'image' => null,
            'status' => 1
        ]);

        Collection::create([
            'name' => "Small Kit",
            'description' =>"<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</strong></p><p><br></p><p><strong>Includes:</strong></p><ul><li><strong>14 Earrings</strong></li><li><strong>9 Bracelets</strong></li><li><strong>9 Necklaces</strong></li></ul><p><br></p>",
            'slug' => 'small-kit',
            'regular_price' => '144.44',
            'sale_price' => '144.44',
            'image' => null,
            'status' => 1
        ]);

        Collection::create([
            'name' => "Large Kit",
            'description' =>"<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</strong></p><p><br></p><p><strong>Includes:</strong></p><ul><li><strong>14 Earrings</strong></li><li><strong>9 Bracelets</strong></li><li><strong>9 Necklaces</strong></li><li><strong>10 Sets (Earrings and Necklace Sets)</strong></li></ul><p><br></p>",
            'slug' => 'large-kit',
            'regular_price' => '244.44',
            'sale_price' => '244.44',
            'image' => null,
            'status' => 1
        ]);

        Collection::create([
            'name' => "Executive Kit",
            'description' =>"<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</strong></p><p><br></p><p><strong>Includes:</strong></p><ul><li><strong>14 Earrings</strong></li><li><strong>18 Bracelets</strong></li><li><strong>18 Necklaces</strong></li><li><strong>20 Sets (Earring and Necklace Sets)</strong></li></ul><p><br></p>",
            'slug' => 'executive-kit',
            'regular_price' => '444.44',
            'sale_price' => '444.44',
            'image' => null,
            'status' => 1
        ]);
    }
}
