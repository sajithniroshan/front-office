<?php

session_start();

date_default_timezone_set('Asia/Colombo');

// Autoload all the files responsible for the classes.
spl_autoload_register(function($class){
  require_once 'classes/'.$class.'.php';
});

// functions
require_once 'functions.php';


// DEFINE
// define("COST_PER_WORD", 4);
define("IS_LIVE", 0); // 1 == Hosted | 0 == localhost

if( IS_LIVE == 0 ){

  $reCAPTCHA_siteKey = "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI";
  $reCAPTCHA_secretKey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";

}elseif( IS_LIVE == 1 ){

  $reCAPTCHA_siteKey = "";
  $reCAPTCHA_secretKey = "";

}