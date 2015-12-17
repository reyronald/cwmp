<?php

namespace App\CWMP;

use App\Inform;

use CWMP\IInformRequestStorage;
use CWMP\InformRequest;

class InformRequestDBStorage implements IInformRequestStorage
{
	public function store(InformRequest $i)
	{
		$inform = new Inform;
		$inform->inform_header_id 			= $i->ID;
		$inform->manufacturer 				= $i->Manufacturer;
		$inform->oui 						= $i->OUI;
		$inform->product_class 				= $i->ProductClass;
		$inform->serial_number 				= $i->SerialNumber;
		$inform->event_code 				= $i->EventCode;
		$inform->max_envelopes 				= $i->MaxEnvelopes;
		$inform->current_time 				= $i->CurrentTime;
		$inform->retry_count 				= $i->RetryCount;
		$inform->hardware_version 			= isset($i->ParameterList['InternetGatewayDevice.DeviceInfo.HardwareVersion']) ? $i->ParameterList['InternetGatewayDevice.DeviceInfo.HardwareVersion'] : null;
		$inform->software_version 			= isset($i->ParameterList['InternetGatewayDevice.DeviceInfo.SoftwareVersion']) ? $i->ParameterList['InternetGatewayDevice.DeviceInfo.SoftwareVersion'] : null;
		$inform->spec_version				= isset($i->ParameterList['InternetGatewayDevice.DeviceInfo.SpecVersion']) ? $i->ParameterList['InternetGatewayDevice.DeviceInfo.SpecVersion'] : null;
		$inform->provisioning_code 			= isset($i->ParameterList['InternetGatewayDevice.DeviceInfo.ProvisioningCode']) ? $i->ParameterList['InternetGatewayDevice.DeviceInfo.ProvisioningCode'] : null;
		$inform->parameter_key 				= isset($i->ParameterList['InternetGatewayDevice.ManagementServer.ParameterKey']) ? $i->ParameterList['InternetGatewayDevice.ManagementServer.ParameterKey'] : null;
		$inform->connection_request_url 	= isset($i->ParameterList['InternetGatewayDevice.ManagementServer.ConnectionRequestURL']) ? $i->ParameterList['InternetGatewayDevice.ManagementServer.ConnectionRequestURL'] : null;
		$inform->external_ip_address		= isset($i->ParameterList['InternetGatewayDevice.WANDevice.1.WANConnectionDevice.1.WANIPConnection.1.ExternalIPAddress']) ? $i->ParameterList['InternetGatewayDevice.WANDevice.1.WANConnectionDevice.1.WANIPConnection.1.ExternalIPAddress'] : null;
		$inform->allow_ping_from_wan 		= isset($i->ParameterList['InternetGatewayDevice.WEB_GUI.Firewall.Basic.Firewall_Configuration.Allow_Ping_From_WAN']) ? $i->ParameterList['InternetGatewayDevice.WEB_GUI.Firewall.Basic.Firewall_Configuration.Allow_Ping_From_WAN'] : null;

		$inform->save();

		return $inform->id;
	}
}
