<?php
//require_once 'core/bootstrap.php'; // using htaccess now

// demo auth send header
//header("Authorization: Basic ZGVlcGFrOmp1ZTQ5ODl2czl2MmprNzZ0eDg3M2I4ZTUzZDRjMjc2");

// Define the accepted methods 
Router::accept(['GET']);

//Basic OAuth authentication
OAuth::enable();

//$name = ;
//$age = '20';

//Database connection
//Database::query("SELECT * FROM employees WHERE name = ? AND age = ? OR age = ?");
/*
$data = Database::execute(array(
	Parameter::string('B'),
	Parameter::int(22),
	Parameter::int(20)
	));
*/	
Database::query("SELECT * FROM employees WHERE name = ?");
$data = Database::execute(Parameter::string('B'));
print_r($data);