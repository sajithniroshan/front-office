<?php header("Content-Type: application/json"); ?>
<?php include_once "../_config/config.php"; ?>
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

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && Token::check(Input::post('token'))) {

        $validate_array = array();

        $validate_array['nic'] = array(
            'required' => array(true, 'This is required'),
            'min' => array(10, 'NIC must contain at least 10 characters'),
            'max' => array(12, 'NIC must contain at maximum 12 characters')
        );

        $validate_array['name'] = array(
            'required' => array(true, 'This field is required'),
            'name' => array(true, 'Name must be well formatted')
        );

        $validate_array['phone'] = array(
            'required' => array(true, 'This field is required'),
            'min' => array(10, 'Telephone number must contain at least 10 characters'),
            'max' => array(12, 'Telephone number must contain at maximum 12 characters')
        );

        $validate_array['address'] = array(
            'required' => array(true, 'This fields is required')
        );

        $validate_array['gn'] = array(
            'required' => array(true, 'This field is required')
        );

        $validate_array['village'] = array(
            'required' => array(true, 'This field is required')
        );

        $validate_array['section'] = array(
            'required' => array(true, 'This field is required')
        );

        // $validate_array['remarks'] = array(
        //     'required' => array(true, 'This field is required')
        // );

        $validate = new Validation();
        $validation = $validate->check($_POST, $validate_array);

        if($validation->passed()){
            echo json_encode(["status" => "success", "message" => "Form Submitted"]);
        }else{
            $validateErr = $validation->errors();
            echo json_encode(["status" => "error", "message" => json_encode($validateErr), "token" => Token::generate()]);
        }

        


    }

?>