<?php
//require_once 'core/bootstrap.php'; // using htaccess now

// demo auth send header
//header("Authorization: Basic ZGVlcGFrOmp1ZTQ5ODl2czl2MmprNzZ0eDg3M2I4ZTUzZDRjMjc2");

// Define the accepted methods 
Router::accept(['GET']);

//Basic OAuth authentication
OAuth::enable();

//Database connection
Database::query();


