<?php

use Illuminate\Database\Seeder;
use App\Blog;
use Carboon\Carboon;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'user_id' => 1,
            'title' => 'My First Blog',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer metus velit, varius quis metus a, gravida suscipit turpis. Maecenas in sem lorem. Phasellus dapibus, lectus eget congue tincidunt, odio erat laoreet libero, consequat fermentum quam nisl at quam. Praesent euismod ante et tellus blandit cursus. Phasellus non lectus eu nisl ultricies fringilla. Aliquam erat volutpat. Phasellus at eleifend purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam vitae sem ligula. Morbi aliquet sodales pharetra. Phasellus vitae libero posuere, fermentum ante sit amet, tristique neque. Nam eleifend maximus efficitur.

            Sed at vehicula nisl. Praesent lobortis rhoncus tortor non efficitur. Pellentesque pulvinar in purus nec semper. Fusce imperdiet consequat magna, vitae efficitur nulla. Vestibulum quis lorem sed libero tincidunt vehicula in eget magna. Phasellus pulvinar nunc vitae ante vehicula sodales quis eu mauris. Praesent blandit consectetur sapien, vel iaculis libero efficitur ac. Quisque in sagittis sem, sit amet aliquet ex. Nunc et ipsum placerat ante maximus imperdiet. Quisque elementum condimentum massa et ultricies. Nunc maximus ornare tellus ac volutpat. Nullam imperdiet egestas augue at mattis. Quisque sed molestie ex, vitae vulputate nisi. Pellentesque molestie euismod urna, et sollicitudin augue finibus vitae.'
        ]);
    }
}
