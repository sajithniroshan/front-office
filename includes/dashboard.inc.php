<?php 

    // Check alreday login a admin
    if( !Session::exists(Config::get('session:session_id')) ){
        header('location:'.Config::get('url:base'));
        exit();
    }

    $adminID = Session::get(Config::get('session:session_id'));

    if( isSignedIn($adminID, array("root","subject", "front-office")) == false ) {
        header('location:'.Config::get('url:base').'logout.php');
        exit();
    }

    $this_admin = DB::getInstance()->query("SELECT * FROM admin WHERE admin_id = ".$adminID)->first();
    $this_year = date("Y");

?>