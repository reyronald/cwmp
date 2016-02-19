<?php

namespace CWMP\App

use CWMP\Model\Inform;
use CWMP\Model\ParameterList;

use CWMP\IGetParameterValuesResponseStorage;
use CWMP\GetParameterValuesResponse;

class GetParameterValuesResponseDBStorage implements IGetParameterValuesResponseStorage
{
	public function store(GetParameterValuesResponse $r, $informId)
	{
		$parameterList = new ParameterList;
		$parameterList->imsi 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.Device_Status.Device_Status.IMSI'];
		$parameterList->wan_mac 		= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.Network_Status.WAN_Information.WAN_MAC'];
		$parameterList->model_id 		= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.Device_Status.Device_Status.Model_ID'];
		$parameterList->model_name 		= $r->ParameterValues['InternetGatewayDevice.DeviceInfo.ModelName'];
		$parameterList->state 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.State'];
		$parameterList->connect_time 	= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.ConnectTime'];
		$parameterList->device_up_time 	= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.System_Status.System_Information.Device_Up_Time'];
		$parameterList->dl_frequency 	= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.DL_Frequency'];
		$parameterList->ul_frequency 	= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.UL_Frequency'];
		$parameterList->bandwidth 		= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.Bandwidth'];
		$parameterList->rsrp0 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.RSRP0'];
		$parameterList->rsrp1 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.RSRP1'];
		$parameterList->rsrq 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.RSRQ'];
		$parameterList->cinr0 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.CINR0'];
		$parameterList->cinr1 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.CINR1'];
		$parameterList->txpower 		= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.TXPower'];
		$parameterList->cell_id 		= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.CellID'];
		$parameterList->pci 			= $r->ParameterValues['InternetGatewayDevice.WEB_GUI.Status.LTE_Status.LTE_System.PCI'];
		$parameterList->soap_envelope 	= file_get_contents("php://input");

		$inform = Inform::find($informId);
		$inform->parameterList()->save($parameterList);
	}
}