<?php
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
class MY_Input extends CI_Input {
	private static $request_params  = null;
	protected $_files = array();
    protected $files = array();

	public function MY_Input()
    {
        $this->_files = $_FILES;
        $this->_clean_input_files();
    }

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

    function _clean_input_files()
    {
        if (is_array($this->_files) && count($this->_files) > 0)
        {
            foreach ($this->_files as $field => $value ) {
                foreach ($this->_files[$field] as $file_element => $file_element_value) {
                    if (is_array($this->_files[$field][$file_element]))
                    {
                        $this->set_object_data_file($field ,$file_element, $file_element_value);
                    }else{
                        $this->files[$field][$file_element] = $file_element_value;
                    }
                }
            }
        }
    }

    function set_object_data_file($outer_object, $file_element = null, $file_element_value, $previous_key_chain=null)
    {
        if (is_null($previous_key_chain))
        {
            $previous_key_chain = "['".$outer_object."']";
        }
        if (is_array($file_element_value))
        {
            foreach ($file_element_value as $child_key => $child_value) {
                $current_key_chain = $previous_key_chain."['".$child_key."']";
                $this->set_object_data_file($outer_object,$file_element,$child_value,$current_key_chain);
            }
        }else{
            eval("\$this->files".$previous_key_chain."['".$file_element."'] = \$file_element_value;");
        }

    }

    function file($index = "", $xss_clean = false)
    {
        return $this->_fetch_from_array($this->files, $index, $xss_clean);
    }

    function _file($index = "", $xss_clean = false)
    {
        return $this->_fetch_from_array($this->_files, $index, $xss_clean);
    }

    function files()
    {
        return $this->files;
    }

    function _files()
    {
        return $this->_files;
    }


}

