<?php

class Router{
	private static $requestedMethod;
	private static $allowedMethods;

	public static function requestMethod(){
		return Router::$requestedMethod;
	}

	public static function accept($allowedMethods){

		Router::$requestedMethod = $_SERVER['REQUEST_METHOD'];
		Router::$allowedMethods = array_map('strtoupper', $allowedMethods);

		if(in_array(Router::$requestedMethod, Router::$allowedMethods)){
			return true;
		}else{
			header('HTTP/1.0 405 Method not allowed');
			$response = array(
				'status' => 'error',
				'message'=> '405 Method not allowed'
				);
			echo json_encode($response);
			exit;
		}

	}

}