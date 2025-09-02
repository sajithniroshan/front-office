<?php

class Init{

	protected static $config = array(
	    'mysql' => array(
		    'host'=> 'localhost',
		    'user'=> 'root',
		    'pwd'=> '',
		    'db'=> 'gov_office'
	  	),
	  	'session' => array(
		    'token_name' => 'gov-office-token',
		    'session_name'=> 'gov-office-name', 
		    'session_id'=> 'gov-office-id',
		    'session_type'=> 'gov-office-type'
	  	),
	  	'cookie' => array(
		    'remember_me' => 'gov_remember'
	  	),
	  	'url' => array(
	  		'base' => 'http://localhost/front-office/',
	  	),
	);

}