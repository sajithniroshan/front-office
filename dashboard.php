<?php include_once "_config/config.php"; ?>
<?php include_once "includes/dashboard.inc.php"; ?>
<?php include_once "parts/header_top.php"; ?>
<?php include_once "parts/header_bottom.php"; ?>
<?php include_once "parts/navbar.php"; ?>


<!-- Main container -->
<div class="container my-4">

	<?php if(Session::exists("success_msg")){ echo siteAlert('alert-success', Session::flash("success_msg")); } // Success msg show  }?>

	<!-- Search Reports -->
	<section id="search_box">
		<div class="card mb-4 animate__animated animate__fadeInDown">
			<div class="card-header bg-light fw-semibold">Search...</div>
			<div class="card-body">
				<form class="row g-3">
					<div class="col-md-3">
						<div class="form-floating">
							<input type="text" class="form-control si" id="search" placeholder="JOB No">
							<label for="jobNo" class="si">JOB No | NIC | NAME</label>
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
					<div class="col-md-3">
						<div class="form-floating">
							<?php
								echo Form::form_dropdown('searchStatus', ddOption('requirement_state', 'state_id', 'state_name', '-- Status --'), Input::post('searchStatus'), array('class' => 'form-select', 'id' => 'searchStatus'));
								echo Form::form_label('Status', 'searchStatus', array('class' => ''));
							?>
						</div>
					</div>
					<div class="col-md-2 d-flex gap-2 align-items-center">
						<button type="button" id="search_reset" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
						<button type="button" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i class="bi bi-printer"></i></button>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- Reports Tabs -->
	<section id="report_area">
		<div class="card animate__animated animate__fadeInUp">
			<div class="card-header fw-semibold">JOB List | <span id="data_about"><?php echo date('l, F j, Y'); ?></span></div>
			<div class="card-body">
				<div id="job_list" style="min-height:500px">
					
					<table class="table table-bordered" >
						<thead>
							<tr>
								<th class="text-nowrap text-center d-none d-md-table-cell">JOB NO</th>
								<th class="w-100 text-center si">NAME</th>
								<th class="text-nowrap text-center si d-none d-md-table-cell">NIC</th>
								<th class="text-nowrap text-center si d-none d-md-table-cell">DATE</th>
								<th class="text-nowrap text-center si"></th>
							</tr>
						</thead>
						<tbody >
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</section>

</div>

<?php include_once "parts/footer_top.php"; ?>
<script src="<?php echo baseUrl('ajax/set-village.js'); ?>"></script>
<script src="<?php echo baseUrl('ajax/user-list.js'); ?>"></script>
<?php include_once "parts/footer_bottom.php"; ?>