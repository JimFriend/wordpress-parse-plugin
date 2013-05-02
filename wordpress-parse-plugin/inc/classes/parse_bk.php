<?php

class parseRestClient {
	public function __construct() {
		$this->_appid = PARSE_APP_ID;
    	$this->_masterkey = PARSE_MASTER_KEY;
    	$this->_restkey = PARSE_API_KEY;
    	$this->_parseurl = PARSE_API_URL;
    	
    	echo "<br />======<br />";
    	
    	echo $this->_appid;

    	echo "<br />======<br />";

		if( empty( $this->_appid ) || empty( $this->_restkey ) || empty( $this->_masterkey ) ) {
			$this->throwError( 'You must set your Application ID, Master Key and REST API Key' );
		}

		$version = curl_version();
		$ssl_supported = ( $version['features'] & CURL_VERSION_SSL );

		if( !$ssl_supported ) {
			$this->throwError( 'CURL SSL support not found' );	
		}
	}

	/*
	 * All requests go through this function
	 * 
	 *
	 */	
	public function request( $args ) {
		$isFile = false;
		$c = curl_init();
		
		curl_setopt( $c, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $c, CURLOPT_USERAGENT, 'parse.com-php-library/2.0' );
		curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $c, CURLINFO_HEADER_OUT, true );
		
		curl_setopt( $c, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'X-Parse-Application-Id: ' . $this->_appid,
			'X-Parse-REST-API-Key: ' . $this->_restkey,
			'X-Parse-Master-Key: ' . $this->_masterkey
		));	
		
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, $args['method']);
		$url = $this->_parseurl . $args['requestUrl'];

		curl_setopt( $c, CURLOPT_URL, $url );

		$response = curl_exec( $c );
		$responseCode = curl_getinfo( $c, CURLINFO_HTTP_CODE );

		$expectedCode = '200';
		
		if( $expectedCode != $responseCode ) {
			//BELOW HELPS WITH DEBUGGING
			print_r( $response );
			print_r( $args );		
		}
		
		return $this->checkResponse( $response, $responseCode, $expectedCode );
	}

	public function dataType( $type, $params ) {
		if( $type != '' ) {
			switch( $type ) {
				case 'date':
					$return = array(
						"__type" => "Date",
						"iso" => date( "c", strtotime( $params ) )
					);
					break;
				case 'bytes':
					$return = array(
						"__type" => "Bytes",
						"base64" => base64_encode( $params )
					);			
					break;
				case 'pointer':
					$return = array(
						"__type" => "Pointer",
						"className" => $params[0],
						"objectId" => $params[1]
					);			
					break;
				case 'geopoint':
					$return = array(
						"__type" => "GeoPoint",
						"latitude" => floatval( $params[0] ),
						"longitude" => floatval( $params[1] )
					);			
					break;
				case 'file':
					$return = array(
						"__type" => "File",
						"name" => $params[0],
					);			
					break;
				case 'increment':
					$return = array(
						"__op" => "Increment",
						"amount" => $params[0]
					);
					break;
				case 'decrement':
					$return = array(
						"__op" => "Decrement",
						"amount" => $params[0]
					);
					break;
				default:
					$return = false;
					break;	
			}
			
			return $return;
		}	
	}

	public function throwError( $msg, $code=0 ) {
		throw new ParseLibraryException( $msg, $code );
	}

	private function checkResponse( $response, $responseCode, $expectedCode ) {
		//TODO: Need to also check for response for a correct result from parse.com
		if( $responseCode != $expectedCode ) {
			$error = json_decode( $response );
			$this->throwError( $error->error, $error->code );
		} else {
			//check for empty return
			if( $response == '{}' ) {
				return true;
			} else {
				return json_decode( $response );
			}
		}
	}
}

class ParseLibraryException extends Exception {
	public function __construct( $message, $code = 0, Exception $previous = null ) {
		//codes are only set by a parse.com error
		if( $code != 0 ) {
			$message = "parse.com error: " . $message;
		}

		parent::__construct( $message, $code, $previous );
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}

?>