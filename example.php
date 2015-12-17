<?php

use CWMP;
use App\CWMP;

const FILE_STORAGE 	= 0;
const DB_STORAGE 	= 1;

$informStorage;
$paramValuesStorage;

switch (DB_STORAGE) {
	case FILE_STORAGE:
		$informStorage 		= new InformRequestFileStorage();
		$paramValuesStorage = new GetParameterValuesResponseFileStorage();
		break;

	case DB_STORAGE:
		$informStorage 		= new InformRequestDBStorage();
		$paramValuesStorage = new GetParameterValuesResponseDBStorage();
		break;
	
	default:
		$informStorage 		= null;
		$paramValuesStorage = null;
		break;
}

$acs = new AutoConfigurationServer(
	$informStorage,
	$paramValuesStorage,
	[
		'InformResponse'	=> "resources\InformResponse.xml",
		'PendingRequests'	=> [
			"resources\GetParameterValues.xml",
		]
	]
	);

$acs->handle();
