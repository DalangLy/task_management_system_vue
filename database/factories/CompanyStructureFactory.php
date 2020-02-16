<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyStructure;
use Faker\Generator as Faker;

$factory->define(CompanyStructure::class, function (Faker $faker) {
    return [
        'company_name' => 'Dalang',
    ];
});
