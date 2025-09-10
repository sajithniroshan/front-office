<div class="card mb-4 animate__animated animate__fadeInUp">
	<div class="card-header bg-light fw-semibold"><span class="si">සේවාලාභින් ලියාපදිංචිය</span> | Create New Job</div>
	<div class="card-body">
		<form class="row g-3" id="registerForm">
			<div class="col-md-3">
				<div class="form-floating">
					<?php
						echo Form::form_input('nic', Input::post('nic'), array('class' => 'form-control si', 'placeholder' => 'ජා.හැ. අංකය', 'id' => 'nic'));
						echo Form::form_label('ජා.හැ. අංකය <span class="text-danger">*</span>', 'nic', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating">
					<?php
						echo Form::form_input('name', Input::post('name'), array('class' => 'form-control si', 'placeholder' => 'නම', 'id' => 'name'));
						echo Form::form_label('නම <span class="text-danger">*</span>', 'name', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-floating">
					<?php
						echo Form::form_input('phone', Input::post('phone'), array('class' => 'form-control si', 'placeholder' => 'දුරකථන අංකය', 'id' => 'phone'));
						echo Form::form_label('දුරකථන අංකය <span class="text-danger">*</span>', 'phone', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-floating">
					<?php
						echo Form::form_input('address', Input::post('address'), array('class' => 'form-control si', 'placeholder' => 'ලිපිනය', 'id' => 'address'));
						echo Form::form_label('ලිපිනය <span class="text-danger">*</span>', 'address', array('class' => 'si'));
					?>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-floating">
					<?php
					echo Form::form_dropdown('gn', ddOption('gn', 'gn_id', 'gn_name', '-- Select GN Division --'), Input::post('gn'), array('class' => 'form-select si', 'id' => 'gn'));
					echo Form::form_label('ග්‍රාම නිලධාරි වසම <span class="text-danger">*</span>', 'gn', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-floating">
					<input type="hidden" id="village_hidden" value="<?php echo Input::post('village') ?>">
					<select name="village" id="village" class="form-select si">
						<option value="" >-- Select Village --</option>
					</select>
					<?php echo Form::form_label('ගම <span class="text-danger">*</span>', 'village ', array('class' => 'si')); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-floating">
					<?php
					echo Form::form_dropdown('section', ddOption('section', 'section_id', 'section_name', '-- Select Section --'), Input::post('section'), array('class' => 'form-select si', 'id' => 'section'));
					echo Form::form_label('අංශය <span class="text-danger">*</span>', 'section', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-floating">
					<?php
						echo Form::form_input('remarks', Input::post('remarks'), array('class' => 'form-control si', 'placeholder' => 'වැදගත් කරුණු', 'id' => 'remarks'));
						echo Form::form_label('වැදගත් කරුණු', 'remarks', array('class' => 'si'));
					?>
				</div>
			</div>
			<div class="col-12 d-flex gap-2 mt-4">
				<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>">
				<button type="submit" name="submit" class="btn btn-success formBtn fw-semibold"><i class="bi bi-plus-lg"></i> Save</button>
				<button type="reset" class="btn btn-outline-dark formBtn fw-semibold"><i class="bi bi-x-lg"></i> Cancle</button>
			</div>
		</form>
	</div>
</div>