<?php

namespace CWMP;

interface IGetParameterValuesResponseStorage
{
	public function store(GetParameterValuesResponse $r, $informId);
}

class GetParameterValuesResponseFileStorage implements IGetParameterValuesResponseStorage
{
	public function store(GetParameterValuesResponse $r, $informId = null)
	{
		file_put_contents("parameter_values_results.txt", json_encode($r, JSON_PRETTY_PRINT) . "\r\n\r\n", FILE_APPEND);
	}
}
