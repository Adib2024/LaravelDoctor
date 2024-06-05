composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
php artisan make:model Doctor  -a
php make:controller API/RegisterController
php artisan make:controller API/RegisterController
php artisan make:controller API/DoctorController
