<?php

class Input{

	// Check whether get exists
	public static function exists_get($submit){

		if(isset($_GET[$submit])){
			return true;
		}else{
			return false;
		}
		
	}

	// For get request
	public static function get($item){

		if (isset($_GET[$item])) {
		    // return htmlspecialchars( $_GET[$item], ENT_QUOTES, 'UTF-8' );
		    return $_GET[$item];
		}

		return '';
	}

	// For post request
	public static function post($item){

		if(isset($_POST[$item])){
			// return htmlspecialchars( $_POST[$item], ENT_QUOTES, 'UTF-8' );
			return $_POST[$item];
		}

		return '';
	}

}