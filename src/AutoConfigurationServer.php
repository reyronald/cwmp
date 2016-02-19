<?php

namespace CWMP;

class AutoConfigurationServer
{
	private $rawRequest;
	private $xmlRequest;
	private $methodName;

	public $requestQueue;

	private $informStorage;
	private $paramValuesStorage;
	private $options;

	public function __construct(IInformRequestStorage $informStorage, IGetParameterValuesResponseStorage $paramValuesStorage, array $options)
	{
		$this->informStorage = $informStorage;
		$this->paramValuesStorage = $paramValuesStorage;
		$this->options = $options;

		$this->handleOptionErrors();

		if ( ($this->rawRequest = file_get_contents("php://input")) === '') return;

		$this->xmlRequest = simplexml_load_string($this->rawRequest);
		$this->methodName = $this->methodName();
	}

	private function handleOptionErrors()
	{
		if ( !isset($this->options['InformResponse']) ) throw new Exception('`InformResponse` key missing in $options array.');
		if ( !isset($this->options['PendingRequests']) ) throw new Exception('`PendingRequests` key missing in $options array.');
		elseif ( !is_array($this->options['PendingRequests']) ) throw new Exception('`PendingRequests` key in $options array must be an array of strings of file paths.');
	}

	private function methodName()
	{
		return $this->xmlRequest[0]->children('SOAP-ENV', true)->Body[0]->children('cwmp', true)->getName();
	}

	public function getMethodName()
	{
		return $this->methodName;
	}

	public function handle()
	{
		if ( $this->rawRequest === '') {
			$data = unserialize($_COOKIE['data']);
			$this->requestQueue = $data['pendingRequests'];
			if (count($this->requestQueue) > 0) {
				echo file_get_contents(array_pop($this->requestQueue));
				$data['pendingRequests'] = $this->requestQueue;
				setcookie("data", serialize($data));
			}
			else 
				echo "";
			return;
		}

		switch ( $this->methodName ) {
			case 'Inform':
				$informReq = new InformRequest($this->xmlRequest, $this->informStorage, $this->options);
				break;

			case 'GetParameterValuesResponse':
				$parameterValues = new GetParameterValuesResponse($this->xmlRequest, $this->paramValuesStorage);
				break;

			case 'GetParameterNamesResponse':
				file_put_contents("parameter_names.xml", "\r\n" . file_get_contents("php://input"), FILE_APPEND);
				echo "";
				break;
			
			default:
				$message ="Unknown Method: `{$this->methodName}`\r\n`{$this->rawRequest}`"; 
				echo $message;
				throw new \Exception($message);
				break;
		}
	}
}

