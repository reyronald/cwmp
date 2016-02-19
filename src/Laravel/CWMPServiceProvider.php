<?php

namespace CWMP\Laravel;

use Exception;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class CWMPServiceProvider extends ServiceProvider
{
	public function register()
	{        
		// Publish config
        $config = realpath(__DIR__.'/../config/config.php');

        $this->mergeConfigFrom($config, 'rrey.cwmp');
        
        $this->publishes([
            $config => config_path('rrey.cwmp.php'),
        ], 'config');

        // Publish migrations
        $migrations = realpath(__DIR__.'/../migrations');

        $this->publishes([
            $migrations => $this->app->databasePath().'/migrations',
        ], 'migrations');
	}
}