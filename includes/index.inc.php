<?php

    // Check alreday login a user & if logged redirect to their dashboards.
    if( Session::exists(Config::get('session:session_id')) ){
        header('location:'.Config::get('url:base').'dashboard.php');
        exit();
    }

    $validateErr = array();
    $errMsg = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) && Token::check(Input::post('token'))) {

        $validate_array = array();

        $validate_array['email'] = array(
            'required' => array(true, 'Email address is required'),
            'email' => array(true, 'Email address must be valied')
        );

        $validate_array['password'] = array(
            'required' => array(true, 'Password is required'),
            'min' => array(6, 'Passwords must contain at least 6 characters')
        );

        $validate_array['acc_type'] = array(
            'required' => array(true, 'Account Type is required'),
        );

        $validate = new Validation();
        $validation = $validate->check($_POST, $validate_array);

        // reCAPTCHA 
        $secretKey = $reCAPTCHA_secretKey;
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];

        // Verify reCAPTCHA with Google
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = ['secret' => $secretKey, 'response' => $responseKey, 'remoteip' => $userIP ];

        // Use cURL or file_get_contents
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ]
        ];
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captchaSuccess = json_decode($verify);

        if( $validation->passed() && $captchaSuccess->success){

            $acc_type = Input::post('acc_type');

            $today = date('Y-m-d H:i:s');

            $email = Input::post('email');
            $password = Input::post('password');

            if( $acc_type == "root"){


                $admin_q = DB::getInstance()->query('SELECT * FROM admin WHERE admin_email = "'.$email.'" AND admin_type = "root" AND admin_status = "active"');

                if( $admin_q->count() == 1 ){

                    $admin = $admin_q->first();

                     if ($admin->admin_password == sha1($password)){

                            Session::put(Config::get('session:session_id'), $admin->admin_id);
                            Session::put(Config::get('session:session_name'), $admin->admin_name);
                            Session::put(Config::get('session:session_type'), $admin->admin_type);

                            DB::getInstance()->update('admin', 'admin_id', $admin->admin_id, array('admin_updated_at' => $today));
                            header('location:'.Config::get('url:base').'dashboard.php');
                            exit();

                    }else{

                        $errMsg = "Invalid credentials or inactive account";
                    }

                }else{

                    $errMsg = "Invalid credentials or inactive account";
                }


            }elseif( $acc_type == "front-office" ){


                $admin_q = DB::getInstance()->query('SELECT * FROM admin WHERE admin_email = "'.$email.'" AND admin_type = "front-office" AND admin_status = "active"');

                if( $admin_q->count() == 1 ){

                    $admin = $admin_q->first();

                     if ($admin->admin_password == sha1($password)){

                            Session::put(Config::get('session:session_id'), $admin->admin_id);
                            Session::put(Config::get('session:session_name'), $admin->admin_name);
                            Session::put(Config::get('session:session_type'), $admin->admin_type);

                            DB::getInstance()->update('admin', 'admin_id', $admin->admin_id, array('admin_updated_at' => $today));
                            header('location:'.Config::get('url:base').'dashboard.php');
                            exit();

                    }else{

                        $errMsg = "Invalid credentials or inactive account";
                    }

                }else{

                    $errMsg = "Invalid credentials or inactive account";
                }


            }elseif( $acc_type == "subject" ){

                $admin_q = DBHR::getInstance()->query('SELECT * FROM admin WHERE admin_email = "'.$email.'" AND admin_status = "active"');

                $errMsg = "This is for subject accounts";

            }else{

                $errMsg = "Invalid credentials or inactive account";

            }


        }else{

            if( !$captchaSuccess->success ){ $errMsg  = "Please check I'm not a robot box!"; }
            $validateErr = $validation->errors();
        }


    }

?>