<?php include_once "../_config/config.php"; ?>
<?php

if( isset($_POST['id']) ){

	$user = DB::getInstance()->query('SELECT * FROM user WHERE user_id = '.$_POST['id'])->first();

?>
	
	<div class="loan_info px-3 pt-3">
		

		<div id="data_count" class="si alert alert-light border d-inline-block my-2 mx-0 py-2 px-4 bg-light fw-bold">Status : <strong class="text-primary"> <?php echo getOneVal('requirement_state', 'state_id', $user->user_requirement_state, 'state_name'); ?></strong></div>

		<div id="data_count" class="si alert alert-light border d-inline-block my-0 mb-2 mx-0 py-2 px-4 bg-light fw-bold">පැමිණි දිනය හා වෙීලාව : <strong class="text-primary"> <?php echo $user->user_created_at; ?></strong></div>

		<hr class="mb-4">

		<img class="img img-flued border d-block mb-2" width="200" src="<?php echo baseUrl('uploads/qr/'.$user->user_unique.'.png') ?>"  />
		<a class="btn btn-sm btn-danger mb-4" href="<?php echo baseUrl('uploads/qr/'.$user->user_unique.'.png') ?>" download >Download QR</a>

		<table class="table table-striped table-bordered" style="width:100%">

			<tr>
				<th class="text-nowrap si">නම<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo $user->user_name; ?></span></th>
				<td class="w-100 d-none d-md-table-cell en"><?php echo $user->user_name; ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">ජාතික හැඳුනුම්පත් අංකය<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo $user->user_nic; ?></span></th>
				<td class="w-100 d-none d-md-table-cell en"><?php echo $user->user_nic; ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">ග්‍රාම නිලධාරි වසම<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo getOneVal('gn', 'gn_id', $user->user_gn, 'gn_name'); ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo getOneVal('gn', 'gn_id', $user->user_gn, 'gn_name'); ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">ගම<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo getOneVal('village', 'village_id', $user->user_village, 'village_name'); ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo getOneVal('village', 'village_id', $user->user_village, 'village_name'); ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">ලිපිනය<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo $user->user_address; ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo $user->user_address; ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">දුරකථන අංකය<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo $user->user_telephone; ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo $user->user_telephone; ?></td>
			</tr>

			<tr>
				<th class="text-nowrap si">අංශය<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo getOneVal('section', 'section_id', $user->user_section, 'section_name'); ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo getOneVal('section', 'section_id', $user->user_section, 'section_name'); ?></td>
			</tr>

			<tr>
				<th class="si">වැදගත් කරුණු<span class="d-inline-block d-md-none">&nbsp;:&nbsp;<?php echo $user->user_remarks; ?></span></th>
				<td class="w-100 d-none d-md-table-cell si"><?php echo $user->user_remarks; ?></td>
			</tr>

		</table>

	</div>


<?php } ?>