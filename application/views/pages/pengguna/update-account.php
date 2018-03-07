<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open(current_url(), array('class' => 'form-horizontal'));
echo form_hidden('id', $user->id);
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="nip" class="control-label col-md-3 col-xs-12">NIP : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="nip" class="form-control" value="<?php echo $user->nip ?>" disabled>
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nama Pengguna : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
						<p class="help-block"><?php echo form_error('first_name', '<small class="text-red">', '</small>'); ?></p>
					</div>
					<div class="col-md-4">
						<input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
						<p class="help-block"><?php echo form_error('last_name', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">E-Mail : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="email" name="email" class="form-control" value="<?php echo $user->email ?>">
						<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="control-label col-md-3 col-xs-12">Nomor Telepon : <strong class="text-primary">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="phone" class="form-control" value="<?php echo $user->phone ?>">
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group">
					<label for="file_excel" class="control-label col-md-3 col-xs-12">Foto : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="file" name="file_foto" class="form-control" id="file-excel">
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group" id="block-new-password">
					<label for="new_pass" class="control-label col-md-3 col-xs-12">Password Baru : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="new_pass" class="form-control" value="">
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group" id="block-new-password-again">
					<label for="repeat_pass" class="control-label col-md-3 col-xs-12">Ulangi : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="repeat_pass" class="form-control" value="">
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group" id="block-new-password-old">
					<label for="old_pass" class="control-label col-md-3 col-xs-12">Password Lama : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="old_pass" class="form-control" value="">
						<p class="help-block"><?php echo form_error('old_pass', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('pengguna') ?>" class="btn btn-app hvr-shadow pull-right">
						<i class="ion ion-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app hvr-shadow pull-right">
						<i class="fa fa-save"></i> Simpan
					</button>
				</div>
			</div>
			<div class="box-footer with-border">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional</small>
			</div>
	
<?php  
// End Form
echo form_close();
?>
		</div>
	</div>
</div>