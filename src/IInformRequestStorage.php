<?php

namespace CWMP;

interface IInformRequestStorage
{
	public function store(InformRequest $i);
}

class InformRequestFileStorage implements IInformRequestStorage
{
	public function store(InformRequest $i)
	{
		file_put_contents("inform_results_cwmp.txt", json_encode($i, JSON_PRETTY_PRINT) . "\r\n\r\n", FILE_APPEND);
	}
}