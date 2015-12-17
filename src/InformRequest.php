<?php

namespace CWMP;

class InformRequest
{
	private $string;
	private $xml;

	public $ID;
	public $Manufacturer;
	public $OUI;
	public $ProductClass;
	public $SerialNumber;

	public $EventCode;
	public $MaxEnvelopes;
	public $CurrentTime;
	public $RetryCount;

	public $ParameterList;

	private $storage;
	private $options;

	public function __construct($xml, IInformRequestStorage $_storage, array $options)
	{
		$this->storage = $_storage;
		$this->options = $options;

		$this->ID = (string)$xml[0]->children('SOAP-ENV', true)->Header[0]->children('cwmp', true)->ID;
		
		$inform = $xml[0]->children('SOAP-ENV', true)->Body[0]->children('cwmp', true)->Inform[0]->children('', true);

		foreach ($inform->DeviceId[0] as $key => $value) {
			$this->{$key} = (string)$value;
		}

		$this->EventCode = (string)$inform->Event[0]->children('', true)->EventStruct[0]->EventCode[0];

		$this->MaxEnvelopes = (string)$inform->MaxEnvelopes[0];
		$this->CurrentTime = (string)$inform->CurrentTime[0];
		$this->RetryCount = (string)$inform->RetryCount[0];

		foreach ($inform->ParameterList[0]->children('', true) as $key => $value) {
			$this->ParameterList[ (string)$value->Name ] = (string)$value->Value;
		}

		$this->store();
		$this->respond();
	}

	private function store()
	{
		$informId = $this->storage->store($this);

		$data = [
			'informId' => $informId,
			'pendingRequests' => $this->options['PendingRequests']
		];
		setcookie("data", serialize($data));
	}

	public function respond()
	{
		echo str_replace('{$ID}', $this->ID, file_get_contents($this->options['InformResponse']));
	}
}