<?php
//require_once '../core/bootstrap.php'; // using htaccess now

class OAuth{
	private static $token;
	
	public static function getHeaders(){

		$headerStack = getallheaders(); // Requires php 5.4+ 

		if(isset($headerStack['Authorization'])){
			OAuth::$token = end(explode(' ', $headerStack['Authorization']));
		}

		if(in_array(OAuth::$token, TokenServer::getKeys())){
			return true;
		}
		else{
			return false;
		}

	}

	public static function enable(){

		if(!OAuth::getHeaders()){

			header('HTTP/1.0 401 Unauthorized');
			$response = array(
				'status' => 'error',
				'message'=> '401 Unauthorized'
				);
			echo json_encode($response);
			exit;
		}
	}
}



