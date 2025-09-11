<?php 

    // Check alreday login a admin
    if( !Session::exists(Config::get('session:session_id')) ){
        header('location:'.Config::get('url:base'));
        exit();
    }

    $adminID = Session::get(Config::get('session:session_id'));
    $user_id = Input::get('id');

    if( isSignedIn($adminID, array("root", "front-office")) == false ) {
        header('location:'.Config::get('url:base').'logout.php');
        exit();
    }

    $this_user_q = DB::getInstance()->query("SELECT * FROM user WHERE user_id = ".$user_id);

    if( $this_user_q->count() == 1 ){
        $this_user = $this_user_q->first();
    }else{
        header('location:'.Config::get('url:base').'dashboard.php');
        exit();
    }

?>


<?php

    $validateErr = array();
    $errMsg = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit']) && Token::check(Input::post('token'))) {

        $validate_array = array();

        $validate_array['nic'] = array(
            'required' => array(true, 'NIC field is required'),
            'min' => array(10, 'NIC must contain at least 10 characters'),
            'max' => array(12, 'NIC must contain at maximum 12 characters')
        );

        $validate_array['name'] = array(
            'required' => array(true, 'Name field is required'),
            'name' => array(true, 'Name must be well formatted')
        );

        $validate_array['phone'] = array(
            'required' => array(true, 'Telephone number field is required'),
            'min' => array(10, 'Telephone number must contain at least 10 characters'),
            'max' => array(12, 'Telephone number must contain at maximum 12 characters')
        );

        $validate_array['address'] = array(
            'required' => array(true, 'Address fields is required')
        );

        $validate_array['gn'] = array(
            'required' => array(true, 'GN field is required')
        );

        $validate_array['village'] = array(
            'required' => array(true, 'Village field is required')
        );

        $validate_array['section'] = array(
            'required' => array(true, 'Section field is required')
        );

        // $validate_array['remarks'] = array(
        //     'required' => array(true, 'Remarks field is required')
        // );

        $validate = new Validation();
        $validation = $validate->check($_POST, $validate_array);

        if($validation->passed()){

            $unique = $this_user->user_id.date('HismYd');

            $fields = array(
                'user_name' => Input::post('name'),
                'user_nic' => Input::post('nic'),
                'user_telephone' => Input::post('phone'),
                'user_address' => Input::post('address'),
                'user_gn' => Input::post('gn'),
                'user_village' => Input::post('village'),
                'user_section' => Input::post('section'),
                'user_remarks' => Input::post('remarks')
             );

            try {

                // Update data to application table.
                if(!DB::getInstance()->update('user', 'user_id', $this_user->user_id, $fields)){
                    throw new Exception('There was a problem of inserting data');
                }else{

                    Session::delete("success_msg");
                    Session::flash("success_msg", "<strong>Submission success :</strong> User updated successfully.");
                    header('location:'.Config::get('url:base').'dashboard.php');
                    exit();
                }

            } catch (Exception $e) {
                $errMsg  = $e->getMessage();
            }

            
        }else{
            $validateErr = $validation->errors();
            $errMsg = "<strong>Submission success :</strong> Re-check enterd data.";
        }

        


    }

?>