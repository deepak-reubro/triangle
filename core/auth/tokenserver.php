<?php

class TokenServer{
	private static $authKeys;

	public static function setKeys(){
       
        /* This has to be taken from the user database
        * Format:- base64 encoding of username:password
        */

		TokenServer::$authKeys = array(
			'cmV1YnJvOmQ2MzU2YWQ1ZGMwYTcyMGMxOGI1M2I4ZTUzZDRjMjc0',
			'cHJhamluYTp5OGYzZ2pkNWRjMGFpOHMybm9iNTNiOGU1M2Q0YzI3NQ==',
			'ZGVlcGFrOmp1ZTQ5ODl2czl2MmprNzZ0eDg3M2I4ZTUzZDRjMjc2'
			);
	}

	public static function getKeys(){
		TokenServer::setKeys();
		return TokenServer::$authKeys;
	}

}

/*
Username =  alphanumberic without ':' character 
Password =  32 character 128 bit alphanumberic
API Key = base64 encoded username:password format
*/

/*
reubro:d6356ad5dc0a720c18b53b8e53d4c274
cmV1YnJvOmQ2MzU2YWQ1ZGMwYTcyMGMxOGI1M2I4ZTUzZDRjMjc0

prajina:y8f3gjd5dc0ai8s2nob53b8e53d4c275
cHJhamluYTp5OGYzZ2pkNWRjMGFpOHMybm9iNTNiOGU1M2Q0YzI3NQ==

deepak:jue4989vs9v2jk76tx873b8e53d4c276
ZGVlcGFrOmp1ZTQ5ODl2czl2MmprNzZ0eDg3M2I4ZTUzZDRjMjc2
*/