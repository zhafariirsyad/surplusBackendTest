<?php

use App\Category;
use App\CategoryProduct;
use App\Image;
use App\Product;
use App\ProductImage;
use Illuminate\Database\Seeder;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder for Category
        // enable 0 or 1, 0 is false/disable, 1 is true/enable
        $category1 = Category::create([
            'name'=>'Healthy Food',
            'enable'=>1
        ]);

        $category2 = Category::create([
            'name'=>'Fast Food',
            'enable'=>0
        ]);
        // End Seeder Category

        // Seeder for Product
        // enable 0 or 1, 0 is false/disable, 1 is true/enable
        $product1 = Product::create([
            'name'=>'Smoothies Buah Naga',
            'description'=>'Smoothie adalah minuman berbahan baku buah-buahan, sayuran, sirup gula/gula pasir, susu tawar cair dan es batu.',
            'enable'=>1
        ]);

        $product2 = Product::create([
            'name'=>'Double Smoked Beef Burger',
            'description'=>'Merupakan burger dengan daging asap ganda.',
            'enable'=>0
        ]);
        // End Seeder Product

        // Seeder for Category Product
        CategoryProduct::create([
            'category_id'=>$category1->id,
            'product_id'=>$product1->id
        ]);

        CategoryProduct::create([
            'category_id'=>$category2->id,
            'product_id'=>$product2->id
        ]);
        // End Seeder Category Product


        // Seeder for Image
        // enable 0 or 1, 0 is false/disable, 1 is true/enable
        $image1 = Image::create([
            'name'=>'Foto Smoothies Buah Naga 1',
            'file'=>'/images/smoothies-buah-naga-foto-resep-utama.webp',
            'enable'=>1
        ]);
        $image2 = Image::create([
            'name'=>'Foto Smoothies Buah Naga 2',
            'file'=>'/images/smoothies-buah-naga-foto-resep-utama2.webp',
            'enable'=>1
        ]);

        $image3 = Image::create([
            'name'=>'Foto Fast Food Burger',
            'file'=>'/images/burger.jpeg',
            'enable'=>1
        ]);
        // End Seeder Image

        // Seeder for Category Product
        ProductImage::create([
            'image_id'=>$image1->id,
            'product_id'=>$product1->id
        ]);

        ProductImage::create([
            'image_id'=>$image2->id,
            'product_id'=>$product1->id
        ]);

        ProductImage::create([
            'image_id'=>$image3->id,
            'product_id'=>$product2->id
        ]);
        // End Seeder Category Product
    }
}
