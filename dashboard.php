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

	<!-- Create New Job -->
	<section id="job_form">
		<div class="card mb-4 animate__animated animate__fadeInUp">
			<div class="card-header bg-light fw-semibold">Create New Job</div>
			<div class="card-body">
				<form class="row g-3">
					<div class="col-md-3">
						<div class="form-floating">
							<input type="text" class="form-control" id="nicNo" placeholder="NIC No">
							<label for="nicNo">NIC No</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-floating">
							<input type="text" class="form-control" id="name" placeholder="Name">
							<label for="name">Name</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-floating">
							<input type="text" class="form-control" id="phone" placeholder="Phone">
							<label for="phone">Phone</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-floating">
							<input type="text" class="form-control" id="address" placeholder="Address">
							<label for="address">Address</label>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-floating">
							<select class="form-select" id="division" aria-label="Division">
								<option selected value="">Select Division</option>
								<option value="1">Sevanagala</option>
								<option value="2">Kiribban Wewa</option>
							</select>
							<label for="division">Division</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
							<select class="form-select" id="division" aria-label="Division">
								<option selected value="">Select Village</option>
								<option value="1">Ekamuthugama</option>
								<option value="2">Sewanagala</option>
							</select>
							<label for="division">Village</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
							<select class="form-select" id="division" aria-label="Division">
								<option selected value="">Select Section</option>
								<option value="1">Admin</option>
								<option value="2">Planning</option>
							</select>
							<label for="division">Section</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-floating">
							<input type="text" class="form-control" id="comment" placeholder="comment">
							<label for="name">Comment</label>
						</div>
					</div>
					<div class="col-12 d-flex gap-2 mt-4">
						<button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Save</button>
						<button type="reset" class="btn btn-outline-dark"><i class="fas fa-times"></i> Cancel</button>
					</div>
				</form>
			</div>
		</div>
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
<?php include_once "parts/footer_bottom.php"; ?>