<?php

namespace App\Providers;


use App\FieldPhoto;
use App\Models\Api\Users\User;
use App\Models\Base\AdditionalOperation\AdditionalOperation;
use App\Models\Base\Event\CropProtectionTreatment;
use App\Models\Base\Event\SowingEvent;
use App\Models\Base\Field\Field;
use App\Models\Base\Projects\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidatorsProvider extends ServiceProvider
{

    public function boot()
    {
        //як би була авторизація так можна було б перевірити, унікальну пошта у випадку коли в мобільщики змінили тільки якийсь один параметр а відправляють всю модель а пошта в такому випадку не пройде по унікальності
        Validator::extend('unique_email', function ($attribute, $value, $parameters, $validator) {
//            $email = auth('api')->user()->email;
//            if ($value == $email) {
//                return TRUE;
//            }
//            return User::where('email', $value)->count() == 0;

            return TRUE;
        });

        Validator::extend('status_project', function ($attribute, $value, $parameters, $validator) {
            return collect(Project::ALL_STATUS)->contains($value);
        });


    }


    public function register()
    {
        //
    }
}
