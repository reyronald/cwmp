# README

#### Laravel 5

Download the package via composer by running:

	composer require "rrey/cwmp":"dev-master"

Include the following in the `app\config.php`'s file `providers` array:

	'providers' => [
		
		... // Other Service Providers
		
		CWMP\Laravel\CWMPServiceProvider::class,

	],

Run the following artisan command:

	php artisan vendor:publish --provider="CWMP\Laravel\CWMPServiceProvider"