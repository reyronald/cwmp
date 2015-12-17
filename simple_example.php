<?php

use CWMP;
use App\CWMP;

$acs = new AutoConfigurationServer(
	new InformRequestFileStorage(),
	new GetParameterValuesResponseFileStorage(),
	[
		'InformResponse'	=> "resources\InformResponse.xml",
		'PendingRequests'	=> [
			"resources\GetParameterValues.xml",
		]
	]
	);

$acs->handle();
