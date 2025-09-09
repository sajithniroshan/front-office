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
							<input type="text" class="form-control" id="jobNo" placeholder="JOB No">
							<label for="jobNo">JOB No</label>
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
							<select class="form-select" id="statusSelect" aria-label="Status">
								<option selected value="">All</option>
								<option value="pending">Pending</option>
								<option value="success">Success</option>
							</select>
							<label for="statusSelect">Status</label>
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
				<div style="height:300px">
					
					<button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
					Hover me
					</button>
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
	        console.log(res);
	        if(res.status === "success"){
	          alert(res.message);
	          $("#registerForm")[0].reset();
	        } else {
	          $("#token").val(res.token);
	          alert("Error: " + res.message);
	          const frmErr = JSON.parse(res.message);
	          Object.keys(frmErr).forEach(key => {
	          	$(`#${key}Err`).text(frmErr[key]);
		      	// console.log(`${key}: ${frmErr[key]}`);
		      });
	        }
	      },
	      error: function(xhr){
	        console.log(xhr.responseText);
	        alert("AJAX error: " + xhr.status + " " + xhr.statusText);
	      }
	    });
	  });
	});

</script>




<?php include_once "parts/footer_bottom.php"; ?>