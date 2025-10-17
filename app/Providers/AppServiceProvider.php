<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Validator::extend('allowcharactersandspace', function ($attribute, $value, $parameters, $validator) {
            $validator->setCustomMessages(['allowcharactersandspace' => ":attribute allowed only alphabets and space"]);
            return preg_match('/^[a-zA-Z\s]*$/', $value);
        });

         Validator::extend('alphanumeric', function ($attribute, $value, $parameters, $validator) {
            $validator->setCustomMessages(['alphanumeric'=>":attribute allowed only alphanumeric"]);
            return preg_match('/^[a-zA-Z0-9]*$/',$value);
        });

        Validator::extend('alpha_num_space_dash', function ($attribute, $value) {
            return preg_match('/^[A-Za-z0-9\s\-]+$/', $value);
        }, 'The :attribute may only contain letters, numbers, spaces, and hyphens.');

        Validator::extend('alpha_space', function ($attribute, $value) {
            return preg_match('/^[A-Za-z\s]+$/', $value);
        }, 'The :attribute may only contain letters and spaces.');

        Validator::extend('valid_email', function ($attribute, $value, $parameters, $validator) {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            $parts = explode('@', $value);
            if (count($parts) !== 2) {
                return false;
            }
            $domain = $parts[1];
            $dotCount = substr_count($domain, '.');
            $domain_values = explode('.', $domain);
            if (count(array_unique($domain_values)) == 1) {
                return false;
            }
            return $dotCount <= 2;
        }, 'The :attribute is a invalid email');

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[0-9]{10}$/', $value);
        }, 'The :attribute must be a valid 10-digit phone number.');

        Validator::extend('phonenumber', function ($attribute, $value, $parameters, $validator) {
            $validator->setCustomMessages(['phonenumber'=>":attribute allowed only phone number"]);
            return preg_match( "/^[6-9][0-9]{9,12}$/" ,$value);
        });
    }
}
