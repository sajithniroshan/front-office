<?php include_once "../_config/config.php"; ?>

<?php 
	
	if($_POST['gn_id'] == ''){
		echo '<option selected value="">-- Select Village --</option>'; 
	}else{

		$gn_id = $_POST['gn_id'];

		$village_data= DB::getInstance()->get('village', array('gn_id', '=', $gn_id))->results();

		$option = '<option selected value="">-- Select Village --</option>';;

		foreach ($village_data as $row) {
			if($_POST['village_hidden'] == $row->village_id){

				$option .= '<option value = '.$row->village_id.' selected>'.$row->village_name.'</option>';

			}else{

				$option .= '<option value = '.$row->village_id.'>'.$row->village_name.'</option>';

			}
			
		}

		echo $option;

	}



?>