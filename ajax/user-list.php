<?php include_once "../_config/config.php"; ?>
<?php

$connect = DB::getInstance();

$limit = '30';
$page = 1;
$page_array = array();

if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

  
$query = "SELECT * FROM user ";

if($_POST['search'] != '' or $_POST['dateFrom'] != '' or $_POST['dateTo'] != '' or $_POST['status'] != ''){
   $query .= 'WHERE 1=1 ';
}

if($_POST['search'] != ''){

	$query .= 'AND (user_unique LIKE "%';
  $query .= str_replace(' ', '%', $_POST['search']).'%" OR ';

  $query .= 'user_name LIKE "%';
  $query .= str_replace(' ', '%', $_POST['search']).'%" OR ';

  $query .= 'user_nic LIKE "%';
  $query .= str_replace(' ', '%', $_POST['search']).'%") ';

}

if($_POST['status'] != ''){
  $query .= 'AND user_requirement_state = '.$_POST['status'].' ';
}


$query .= 'ORDER BY user_id DESC ';
$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';




// var_dump($filter_query);
// die;

$total_data = 0;
$statement = $connect->query($query);
$total_data = $connect->count();


$result = $connect->query($filter_query)->results();
$total_filter_data = $connect->count();


// var_dump($result);
// die;

// ####################################
//  FILTER DATA
// ####################################

$output ='';

if($total_data > 0){

	$output .= '<table class="table table-bordered" >';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th class="text-nowrap text-center d-none d-md-table-cell">JOB NO</th>';
	$output .= '<th class="w-100 text-center si">NAME</th>';
	$output .= '<th class="text-nowrap text-center si d-none d-md-table-cell">NIC</th>';
	$output .= '<th class="text-nowrap text-center si d-none d-md-table-cell">DATE</th>';
	$output .= '<th class="text-nowrap text-center si"></th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody >';

	foreach ($result as $data) {

		

		$output .= '<tr>';
		$output .= '<td class="text-nowrap d-none d-md-table-cell">'.$data->user_unique.'</td>';
		$output .= '<td class="w-100 si">'.$data->user_name.' <span class="d-block d-md-none">('.$data->user_nic.')</span></td>';
		$output .= '<td class="text-nowrap si d-none d-md-table-cell">'.$data->user_nic.'</td>';
		$output .= '<td class="text-nowrap si d-none d-md-table-cell">'.date("Y-M-d", strtotime($data->user_created_at)).'</td>';
		$output .= '<td class="text-nowrap si">';
		$output .= '&nbsp;';
		$output .= '<a href="'.baseUrl('edit.php?id='.$data->user_id).'" class="btn btn-sm btn-primary" title="Edit"><i class="bi bi-pencil-square"></i></a>';
		$output .= '&nbsp;';
		$output .= '<button data-id="'.$data->user_id.'" class="btn btn-sm btn-success show_user" title="View"><i class="bi bi-eye"></i></button>';
		$output .= '&nbsp;';
		$output .= '</td>';
		$output .= '</tr>';

		
	}

	$output .= '</tbody>';
	$output .= '</table>';

}else{

  $output .= '<div class="alert alert-danger text-center py-5" style="font-size: 18px; font-weight:bold">NO DATA</div>';

}



// ###################################

$output .= '
<div align="center">
  <ul class="pagination">
';


// ######################################
// PAGINATION
// ######################################

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" data-page_number="'.$page_array[$count].'" href="#">'.$page_array[$count].'</a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Prev</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Prev</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id > $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

// echo $output;

?>




<?php
	$data = array('status' => 'success', 'output' => $output, 'data' => 'Results : '.$total_data);
	echo json_encode($data);
?>