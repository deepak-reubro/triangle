<?php
// disable default errors
//ini_set('display_errors', 0);

require_once 'databasedriver.php';
require_once(dirname(__FILE__) . '/../config/database.php');

class Database implements DatabaseDriver{

	private static $connection;
	private static $statement;

	public static function connect(){

		Database::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (Database::$connection->connect_errno) {
			$response = array(
				'status' => 'error',
				'message'=> 'MySql Error: ['.Database::$connection->connect_errno.'] '.Database::$connection->connect_error,
				);
			echo json_encode($response);
			exit;
		}
	}

	public static function query($query){
		Database::connect();

        // prepare statement
		if (!(Database::$statement = Database::$connection->prepare($query))) {
			$response = array(
				'status' => 'error',
				'message'=> 'MySql Error: ['.Database::$connection->errno.'] '. Database::$connection->error,
				);
			echo json_encode($response);
			exit;
		}
	}

	public static function execute($variables){

		$dataType = '';
		$data = array();


//print_r($variables);

        // Bind parameters. Types: s = string, i = integer, d = double,  b = blob 
		foreach ($variables as $type => $value) {


			$dataType .= $type;
			$data[] =  &$value;
		}

		$data[] = &$dataType;

		$dataType = array_pop($data);
		array_unshift($data, $dataType);  

         print_r($data); exit;



        // With call_user_func_array, array params must be passed by reference 
		foreach ($variables as $type => $value) {
		//	$data[] = & $value;
		}



		call_user_func_array(array(Database::$statement, 'bind_param'), $data);

		/* Execute statement */
		if(!Database::$statement->execute()){
			echo "Execute failed: (" . Database::$statement->errno . ") " . Database::$statement->error;
		}else{


			if (!($res = Database::$statement->get_result())) {
				echo "Getting result set failed: (" . Database::$statement->errno . ") " . Database::$statement->error;
			}

			for ($row_no = ($res->num_rows - 1); $row_no >= 0; $row_no--) {
				$res->data_seek($row_no);
				print_r($res->fetch_assoc());
			}
			$res->close();


		}

	}


	
}