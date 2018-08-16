<?php

use App\Carrier;
use App\Consignee;
use App\Exporter;
use App\Fruit;
use App\Loading;
use App\PortOfDischarge;
use App\PortOfLoading;
use App\Supplier;
use App\User;
use App\Vessel;
use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'idNumber' => $faker->unique()->numberBetween(100000, 999999),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'role' => $faker->randomElement([User::ADMIN, User::MANAGER]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(PortOfDischarge::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
    ];
});


$factory->define(PortOfLoading::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
    ];
});

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Vessel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Carrier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Exporter::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Fruit::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Loading::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(Consignee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'postal' =>$faker->postcode,
        'address'=>$faker->address,
        'country'=>$faker->country,
        'contact'=>$faker->phoneNumber,
        'city'=>$faker->city,


    ];
});