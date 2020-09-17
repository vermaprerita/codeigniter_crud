<?php
header('Content-Type: application/json');
include('../../wp-config.php');
$response = array();
global $wpdb;
$resp=array();

var_dump(headers_list());die;
	$api_key='45345556';
	$password='rtge5645645errt4';
	// $api_key='313131313131313311';
	// $password='hvdwftyt21e673yudgbwufbduywuueugfufuuj';
	//$url = "https://$yourdomain.freshdesk.com/api/v2/tickets/".$job_id."/reply";
	$url = "https://demo12.mediatrenz.com/paysfer/connect_api/v1";


	// $url = "https://api.paysfer.com/channeladvisor/products?groupFields={}&buyableFields={}";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	// print_r($server_output);
	$info = curl_getinfo($ch);
	//print_r($info);

	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$headers = substr($server_output, 0, $header_size);
	$response_encode = substr($server_output, $header_size);
	print_r($response_encode);
	$response_decode=json_decode($response_encode);

	print_r($response_decode);die;
	if (!empty($response_decode)) {	
		
	}else{
		echo "No data found";
	}

	curl_close($ch);
?>