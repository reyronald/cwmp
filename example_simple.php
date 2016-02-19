<?php

use CWMP;
use CWMP\App;

$acs = new AutoConfigurationServer(
	new InformRequestFileStorage(),
	new GetParameterValuesResponseFileStorage(),
	[
		'InformResponse'	=> __DIR__ . '\resources\InformResponse.xml',
		'PendingRequests'	=> [
			__DIR__ . '\resources\GetParameterValues.xml',
		]
	]
	);

$acs->handle();
