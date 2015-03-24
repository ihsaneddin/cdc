<?php
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Input extends CI_Input {
	private static $request_params  = null;

	public function json() {
	    if ( !self::$request_params ) {
	        $payload    = file_get_contents( 'php://input' );

	        if ( is_array( $payload ) ) {
	            self::$request_params   = $payload;
	        } else if ( ( substr( $payload, 0, 1 ) == "{" ) && ( substr( $payload, ( strlen( $payload ) - 1 ), 1 ) == "}" ) ) {
	            self::$request_params   = json_decode( $payload );
	        } else {
	            parse_str( $payload, self::$request_params );
	        }
	    }

    	return (object) self::$request_params;
	}

}
