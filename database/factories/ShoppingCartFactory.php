<?php
/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Model\ShoppingCart;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ShoppingCart::class, function (Faker $faker) {
    return [
        'session' => 'test_session',
    ];
});