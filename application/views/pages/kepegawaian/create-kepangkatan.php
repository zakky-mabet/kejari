<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<dov class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open_multipart(current_url(), array('class' => 'form-horizontal'));
?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
					<label for="text" class="control-label col-md-3 col-xs-12">TMT : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="date" class="form-control" value="<?php echo set_value('date'); ?>">
						<p class="help-block"><?php echo form_error('date', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="text" class="control-label col-md-3 col-xs-12">Pangkat : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="pangkat" class="form-control" value="<?php echo set_value('pangkat'); ?>">
						<p class="help-block"><?php echo form_error('pangkat', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nomor SK : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="no_sk" class="form-control" value="<?php echo set_value('no_sk'); ?>">
						<p class="help-block"><?php echo form_error('no_sk', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Lampiran SK: <strong class="text-red">*</strong></label>
					<div class="col-md-6">
						<input type="file" name="foto" class="form-control">
						<?php echo form_error('foto', '<small class="text-red">', '</small>'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="golongan" class="control-label col-md-3 col-xs-12">Golongan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="golongan" class="form-control" value="<?php echo set_value('golongan'); ?>">
						<p class="help-block"><?php echo form_error('golongan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="ruang" class="control-label col-md-3 col-xs-12">Ruang : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="ruang" class="form-control" value="<?php echo set_value('ruang'); ?>">
						<p class="help-block"><?php echo form_error('ruang', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="keterangan" class="control-label col-md-3">Keterangan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<textarea name="keterangan" rows="3" class="form-control"><?php echo set_value('keterangan'); ?></textarea>
						<p class="help-block"><?php echo form_error('keterangan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('kepegawaian/detail_kepangkatan') ?>" class="btn btn-app pull-right">
						<i class="ion ion-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
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
	</dov>
</div>