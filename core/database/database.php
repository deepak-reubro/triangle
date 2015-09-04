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

        // Bind parameters. Types: s = string, i = integer, d = double,  b = blob 
		foreach ($variables as $key => $variable) {
			if(is_array($variable)){
				foreach ($variable as $type=> $value) {
					$dataType .= $type;
				}
			}else{
				$dataType .= $key;
			}

		}

		foreach ($variables as $key => $variable) {
			if(is_array($variable)){
				foreach ($variable as $type=> $value) {
					$parameters[] = $value;
				}
			}else{
				$parameters[] = $variable;
			}
		}

        // With call_user_func_array, array params must be passed by reference 
		for($i=0 ;$i<count($parameters); $i++){
			$data[] = &$parameters[$i];
		}

		$data[] = &$dataType;
		$dataType = array_pop($data);
		array_unshift($data, $dataType);  

		call_user_func_array(array(Database::$statement, 'bind_param'), $data);

		/* Execute statement */
		if(!Database::$statement->execute()){
			
			$response = array(
				'status' => 'error',
				'message'=> 'MySql Error: ['.Database::$statement->errno.'] '. Database::$statement->error,
				);
			echo json_encode($response);
			exit;
		}else{

			if (!($result = Database::$statement->get_result())) {

				$response = array(
					'status' => 'error',
					'message'=> 'MySql Error: ['.Database::$statement->errno.'] '. Database::$statement->error,
					);
				echo json_encode($response);
				exit;
			}

			$output = array();

			for ($rowNumber = ($result->num_rows - 1); $rowNumber >= 0; $rowNumber--) {

				$result->data_seek($rowNumber);
				$output[] = $result->fetch_assoc();
			}

			$result->close();
			if(count($output) > 1){
				return $output;
			}else{
				return end($output);
			}  

		}
	}

}