<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Faker\Factory;
use Faker\Generator;

class FakerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerPicsumImagesProvider($faker));
            return $faker;
        });
    }

    public function boot()
    {
        //
    }
}
