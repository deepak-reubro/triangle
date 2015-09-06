<?php

class Response{

	public static function output($result){
		echo json_encode($result);
	}
}