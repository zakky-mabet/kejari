<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-10 col-md-offset-1 col-xs-12">
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
					<label for="pendidikan_terakhir" class="control-label col-md-3 col-xs-12">Nama Pegawai : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="nip" class="form-control">
							<option value="">-- NIP - Nama Pegawai --</option>
							<?php foreach ($this->mgaji_berkala->get_all_gaji() as $key => $value): ?>
                                <option value="<?php echo $value->nip; ?>"><?php echo $value->nama; ?></option>
                            <?php endforeach;?>
						</select>
						<p class="help-block"><?php echo form_error('nip', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">Tanggal Mulai Terdaftar : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="date" id="datepicker" class="form-control" value="<?php echo set_value('date'); ?>">
						<p class="help-block"><?php echo form_error('date', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="nomor_sk" class="control-label col-md-3 col-xs-12">Nomor SK : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="no_sk" class="form-control" value="<?php echo set_value('no_sk'); ?>">
						<p class="help-block"><?php echo form_error('no_sk', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Lampiran SK : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="text" class="control-label col-md-3">Keterangan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<textarea name="keterangan" rows="3" class="form-control"><?php echo set_value('keterangan'); ?></textarea>
						<p class="help-block"><?php echo form_error('keterangan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('gaji_berkala') ?>" class="btn btn-app pull-right">
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
	</div>
</div>