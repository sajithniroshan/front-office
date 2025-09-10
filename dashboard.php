<?php include_once "_config/config.php"; ?>
<?php include_once "includes/dashboard.inc.php"; ?>
<?php include_once "parts/header_top.php"; ?>
<?php include_once "parts/header_bottom.php"; ?>
<?php include_once "parts/navbar.php"; ?>


<!-- Main container -->
<div class="container my-4">

	<!-- Search Reports -->
	<section id="search_box">
		<div class="card mb-4 animate__animated animate__fadeInDown">
			<div class="card-header bg-light fw-semibold">Search Reports</div>
			<div class="card-body">
				<form class="row g-3">
					<div class="col-md-3">
						<div class="form-floating">
							<input type="text" class="form-control si" id="search" placeholder="JOB No">
							<label for="jobNo" class="si">සොයන්න...</label>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-floating">
							<input type="date" class="form-control" id="dateFrom" placeholder="From Date">
							<label for="dateFrom">From Date</label>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-floating">
							<input type="date" class="form-control" id="dateTo" placeholder="To Date">
							<label for="dateTo">To Date</label>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-floating">
							<?php
								echo Form::form_dropdown('searchStatus', ddOption('requirement_state', 'state_id', 'state_name', '-- Status --'), Input::post('searchStatus'), array('class' => 'form-select', 'id' => 'searchStatus'));
								echo Form::form_label('Status', 'searchStatus', array('class' => ''));
							?>
						</div>
					</div>
					<div class="col-md-3 d-flex gap-2 align-items-center">
						<button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Search"><i class="bi bi-search"></i></button>
						<button type="button" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i class="bi bi-printer"></i></button>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- Job fORM -->
	<section id="job_form">
		<?php include_once "sections/regForm.php"; ?>
	</section>

	<!-- Reports Tabs -->
	<section id="report_area">
		<div class="card animate__animated animate__fadeInUp">
			<div class="card-header fw-semibold">JOB List | <?php echo date('l, F j, Y'); ?></div>
			<div class="card-body">
				<div id="job_list" style="height:300px">
					
					<table class="table table-bordered">
						<tr>
							<th class="text-nowrap text-center">JOB No</th>
							<th class="w-100 text-center si">නම</th>
							<th class="text-nowrap text-center si">ජා.හැ. අංකය</th>
							<th class="text-nowrap text-center si">දිනය</th>
							<th class="text-nowrap text-center si"></th>
						</tr>
						<tr>
							<th class="text-nowrap">54714</th>
							<td class="w-100 si">Sajith Niroshan Wanigasingha</td>
							<td class="text-nowrap si">931911724V</td>
							<td class="text-nowrap si">2024-05-12</td>
							<td class="text-nowrap si">
								&nbsp;
								<button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></button>
								&nbsp;
								<button class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye"></i></button>
								&nbsp;
							</td>
						</tr>
					</table>
					
				</div>
			</div>
		</div>
	</section>

</div>

<?php include_once "parts/footer_top.php"; ?>
<script src="<?php echo baseUrl('ajax/set-village.js'); ?>"></script>

<script>

	// Register new customer
	$(function(){
	  $("#registerForm").on("submit", function(e){
	    e.preventDefault();

	    $.ajax({
	      url: "<?php echo baseUrl('ajax/registerForm.php'); ?>",
	      type: "POST",
	      data: $(this).serialize(),
	      dataType: "json",
	      success: function(res){

	        if(res.status === "success"){

	          alert(res.message);
	          $("#registerForm")[0].reset();

	        }else if(res.status === "errorMsg"){

	        	$("#token").val(res.token);
	        	let setMsg = res.message;
	        	alert(setMsg);


	        }else if((res.status === "error")){

	          $("#token").val(res.token);
	          const frmErr = JSON.parse(res.message);
	          let setMsg = '<ul>';
	          Object.keys(frmErr).forEach(key => {
	          	setMsg += "<li>" + frmErr[key] + "</li>";
		      });
		      setMsg += '</ul>';
		      alert(setMsg);

	        } // if end

	      },
	      error: function(xhr){
	        console.log(xhr.responseText);
	        alert("AJAX error: " + xhr.status + " " + xhr.statusText);
	      }
	    });
	  });
	});


	// loadUsers

</script>




<?php include_once "parts/footer_bottom.php"; ?>