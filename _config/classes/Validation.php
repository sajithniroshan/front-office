<?php

class Validation{

    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function __construct(){
      $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){

      foreach ($items as $item => $rules){
        foreach ($rules as $rule => $rule_val){

           $rule_value =  $rule_val[0];
           $rule_text =  $rule_val[1];

          $item = escape($item);
          
          $value = trim($source[$item]);


          if($rule === 'required' && empty($value)){

             $this->addError($item, $rule_text);

          }elseif(!empty($value)){

            switch ($rule) {

              case 'min':
                if(strlen($value) < $rule_value){
                  $this->addError($item, $rule_text);
                }
                break;

              case 'max':
                if(strlen($value) > $rule_value){
                  $this->addError($item, $rule_text);
                }
                break;

              case 'min_val':
                if($value < $rule_value){
                  $this->addError($item, $rule_text);
                }
                break;

              case 'max_val':
                if($value > $rule_value){
                  $this->addError($item, $rule_text);
                }
                break;

              case 'matches':
                    if($value != $source[$rule_value]){
                      $this->addError($item, $rule_text);
                    }
                    break;

              case 'name':
                    if(preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $value)){
                       $this->addError($item, $rule_text); 
                    }
                    break;

              case 'email':
                    if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $this->addError($item, $rule_text);
                    }
                    break;

              case 'birthday':
                    if(date("Y-m-d") < $value){
                        $this->addError($item, $rule_text);
                    }
                    break;

              case 'phone':
                    if(preg_match("/[^0-9-+]$/", $value)){
                       $this->addError($item, $rule_text);
                    }
                    break;

              case 'unique':
                    $unique_data = explode(':', $rule_value);
                    $check = $this->_db->get($unique_data[0], array($unique_data[1], '=', $value));
                    if($check->count()){
                      $this->addError($item, $rule_text);
                    }
                    break;

              case 'unique_for_update': // check unique for except considerd row (table_name:check_col_name(email):table_id:table_id_value)
                    $unique_data = explode(':', $rule_value);
                    $check = $this->_db->query('SELECT * FROM '.$unique_data[0].' WHERE '.$unique_data[2].' != '.$unique_data[3].' AND '.$unique_data[1].' = "'.$value.'"');
                    if($check->count()){
                      $this->addError($item, $rule_text);
                    }
                    break;

            }
          }

        }
      }

      if(empty($this->_errors)){

        $this->_passed = true;
      }

      return $this;
    }


  private function addError($key, $error){
    $this->_errors[$key] = $error;
  }


  public function errors(){
    return $this->_errors;
  }


  public function passed(){
    return $this->_passed;
  }

}