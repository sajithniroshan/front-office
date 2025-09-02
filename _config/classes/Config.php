<?php

class Config extends Init{
	
	// this function allows me to pull relevant information from the GLOBALS array in core/init.php.	
	public static function get($path = null){
		if($path){
			$config = Init::$config;
			$path = explode(':', $path);

			foreach ($path as $part) {
				if(isset($config[$part])){
					$config = $config[$part];
				}
			}
			return $config;
		}
		return false;
	}
}