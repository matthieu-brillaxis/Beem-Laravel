<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// Generate Users

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstName' => $faker->firstName($gender = null),
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'img' => $faker->imageUrl($width = 640, $height = 480)
    ];
});

// Generate Places

$factory->define(App\Place::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
    $faker->addProvider(new Faker\Provider\fr_FR\Company($faker));
    $location = generateRandomLocation();

    return [
        'name' => $faker->company,
        'description' => $faker->text($maxNbChars = 200),
        'adresse' => $faker->streetAddress,
        'code_postal' => $faker->postcode,
        'ville' => $faker->city,
        'horaire_debut' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+60 days', $timezone = null),
        'horaire_fin' => $faker->dateTimeBetween($startDate = '+61 days', $endDate = '+70 days', $timezone = null),
        'latitude' => $location['latitude'],
        'longitude' => $location['longitude']
    ];
});

function generateRandomLocation() {
    $longitude = (float) -0.556826;
    $latitude = (float) 44.825917;
    
    $rd = 25000 / 111300;
  
    $u = (float) rand() / (float) getrandmax();
    $v = (float) rand() / (float) getrandmax();
  
    $w = $rd * sqrt($u);
    $t = 2 * pi() * $v;
    $x = $w * cos($t);
    $y = $w * sin($t);
  
    $xp = $x / cos($latitude);
  
    return array('latitude' => $y + $latitude, 'longitude' => $xp + $longitude);
  }

// Generate Votes

$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->boolean($chanceOfGettingTrue = 50)
    ];
});