<?php include_once "_config/config.php" ?>
<?php
	// Logout process
	if(!Session::exists(Config::get('session:session_id')) ){
        header('location:'.Config::get('url:base'));
        exit();
    }else{

    	Session::delete(Config::get('session:session_id'));
    	Session::delete(Config::get('session:session_name'));
        Session::delete(Config::get('session:session_type'));
    	Session::delete("success_msg");
		Session::flash("success_msg", "Logout successfully.");
    	header('location:'.Config::get('url:base'));
        exit();
    }

?>