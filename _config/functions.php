<?php

// Get base url.
function baseUrl($url_part = null){

	$base_url = Config::get('url:base'); 

	if($url_part == null){

		return $base_url;

	}else{

		return $base_url.$url_part;
	}
	
} // end base_url


// Escape function will ensure that all data coming from our Database tables are in UTF-8 format.
function escape($string){
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}


// form validation err msg show
function frmMsgShow($name, $message = array(), $instruction = ''){

		if(!empty($message)){

			if(array_key_exists($name, $message)){
				$msg = '<small class="form-text text-danger text-left">'.$message[$name].'</small>';
				return $msg;
			}

		}else{

			if(!$instruction == ''){
				$msg = '<small class="form-text text-muted text-left">'.$instruction.'</small>';
				return $msg;
			}
		}

}


// Show alert massage with dismiss
function siteAlert($color_class, $msg){

	// color_class - alert-warning
	// msg - add your massage need to show.

	$text = '<div class="alert '.$color_class.' alert-dismissible fade small show si" role="alert">';
	$text .= $msg;
	$text .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
	$text .= '<span aria-hidden="true">&times;</span>';
	$text .= '</button>';
	$text .= '</div>';

	return $text;

} // end siteAlert


// get valus for dropdown using db tables
function ddOption($table, $id, $value, $default_text, $where = array()) {

	$myArr = array('' => $default_text,);

	if(empty($where)){
		$data = DB::getInstance()->query("SELECT * FROM {$table}");
	}else{
		$data = DB::getInstance()->query("SELECT * FROM {$table} WHERE {$where[0]} {$where[1]} {$where[2]}");
	}
	
	foreach ($data->results() as $row) {
		$myArr[$row->$id] = $row->$value;
	}

	return $myArr;

}

// get valus for dropdown using db tables
function ddOptionNoSelect($table, $id, $value, $where = array()) {

	$myArr = array();

	if(empty($where)){
		$data = DB::getInstance()->query("SELECT * FROM {$table}");
	}else{
		$data = DB::getInstance()->query("SELECT * FROM {$table} WHERE {$where[0]} {$where[1]} {$where[2]}");
	}
	
	foreach ($data->results() as $row) {
		$myArr[$row->$id] = $row->$value;
	}

	return $myArr;

}


// Use to get value one value from table use to Dropdowns.
function getOneVal($table, $id, $id_val, $val){

	$data = DB::getInstance()->query("SELECT * FROM ".$table." WHERE ".$id." = ".$id_val)->first();
	return $data->$val;
}


// Use to get value one value from table use to Dropdowns multi.
function getAllVal($table, $id, $id_val, $val){

    // $id_val must be an array
	$dataArr = array();

	foreach ($id_val as $idv) {
		$data = DB::getInstance()->query("SELECT * FROM ".$table." WHERE ".$id." = ".$idv)->first();
		$dataArr[] = $data->$val;
	}

	return $dataArr;

}

// Month Text
function monthText($month){

	if( $month == 1 ){ return 'January'; }
	elseif( $month == 2 ) { return 'February'; }
	elseif( $month == 3 ) { return 'March'; }
	elseif( $month == 4 ) { return 'April'; }
	elseif( $month == 5 ) { return 'May'; }
	elseif( $month == 6 ) { return 'June'; }
	elseif( $month == 7 ) { return 'July'; }
	elseif( $month == 8 ) { return 'August'; }
	elseif( $month == 9 ) { return 'September'; }
	elseif( $month == 10 ) { return 'October'; }
	elseif( $month == 11 ) { return 'November'; }
	elseif( $month == 12 ) { return 'December'; }
	else{ return 'Error'; }

}

// Month List for dropdown
function monthList($month = ''){

	$monthArr = array(
		''=>'-- SELECT --',
		1=>'January',
		2=>'February',
		3=>'March',
		4=>'April',
		5=>'May',
		6=>'June',
		7=>'July',
		8=>'August',
		9=>'September',
		10=>'October',
		11=>'November',
		12=>'December',
	);

	if( $month == '' ){

		return $monthArr;

	}else{

		return $monthArr[$month];
	}

	

}



// Check SignIn
function isSignedIn($adminID, $accessLevel = array()) {

	$adminData = DB::getInstance()->query('SELECT * FROM admin WHERE admin_id = '.$adminID);
	if( $adminData->count() != 1 ) {
		return false;
	} else {
		$admin = $adminData->first();
		if( empty($accessLevel) ) {
			return false;
		}else{
			if( in_array($admin->admin_type, $accessLevel) ) {
				return true;
			}else{
				return false;
			}

		}
	}

}
