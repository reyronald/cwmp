<?php

namespace CWMP;

class GetParameterValuesResponse
{
	public $ParameterValues;

	private $storage;
	public function __construct($xml, GetParameterValuesResponseStorageable $_storage) 
	{
		$this->storage = $_storage;

		$parameterValues = $xml[0]->children('SOAP-ENV', true)
							->Body[0]->children('cwmp', true)
							->GetParameterValuesResponse[0]->children('', true)
							->ParameterList[0]->children('', true);

		foreach ($parameterValues as $key => $value) {
			$this->ParameterValues[ (string)$value->Name ] = (string)$value->Value;
		}

		$this->store();
		$this->respond();
	}

	private function store()
	{
		$informId = unserialize($_COOKIE['data'])['informId'];
		$this->storage->store($this, $informId);
	}

	public function respond()
	{
		echo "";
	}
}