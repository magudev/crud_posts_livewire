<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        // IMAGE FAKER
        // $faker = \Faker\Factory::create();
        // $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        // return a string that contains a url like 'https://picsum.photos/800/600/'
        // $filename = $faker->imageUrl(640, 480); 

        // download a properly sized image from picsum into a file with a file path like '/tmp/13b73edae8443990be1aa8f1a483bc27.jpg'
        // $filePath= $faker->image('public/storage/posts');

        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(),
            // 'image' => $filename
            'image' => 'posts/prueba.png'
        ];
    }
}
