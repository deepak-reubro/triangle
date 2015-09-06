<?php

/**
* SPL AutoLoader for API
*/

function coreLoader($class){
	$filename = strtolower($class. '.php');
	$file = 'core/'.$filename;
	if(!file_exists($file)){
		return false;
	}else{
		require_once $file;
	}
}

function httpLoader($class){
	$filename = strtolower($class. '.php');
	$file = 'core/http/'.$filename;
	if(!file_exists($file)){
		return false;
	}else{
		require_once $file;
	}
}

function authLoader($class){
	$filename = strtolower($class. '.php');
	$file = 'core/auth/'.$filename;
	if(!file_exists($file)){
		return false;
	}else{
		require_once $file;
	}
}

function dbLoader($class){
	$filename = strtolower($class. '.php');
	$file = 'core/database/'.$filename;
	if(!file_exists($file)){
		return false;
	}else{
		require_once $file;
	}
}

function responseLoader($class){
	$filename = strtolower($class. '.php');
	$file = 'core/response/'.$filename;
	if(!file_exists($file)){
		return false;
	}else{
		require_once $file;
	}
}

spl_autoload_register('coreLoader');

spl_autoload_register('httpLoader');

spl_autoload_register('authLoader');

spl_autoload_register('dbLoader');

spl_autoload_register('responseLoader');