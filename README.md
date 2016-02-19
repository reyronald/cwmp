# README

#### Laravel 5

Include the following in the `app\config.php`'s file `providers` array:

	CWMP\Laravel\CWMPServiceProvider::class

Run the following artisan command:

	php artisan vendor:publish --provider="CWMP\Laravel\CWMPServiceProvider"