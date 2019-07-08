<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Models\Base\Projects\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->text,
        'status'=>Project::STATUS_NEW,
    ];
});
