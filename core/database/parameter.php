<?php

class Parameter{
	public static function int($input){
		return array('i' => $input);
	}

	public static function string($input){
		return array('s' => $input);
	}

	public static function double($input){
		return array('d' => $input);
	}

	public static function blob($input){
		return array('b' => $input);
	}
}