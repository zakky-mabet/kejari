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
					<label for="name" class="control-label col-md-3 col-xs-12">Pegawai : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="nip" class="form-control">
							<option value="0">-- NIP - Nama Pegawai --</option>
							<?php foreach ($this->mdiklat->get_all() as $key => $value): ?>
                                <option value="<?php echo $value->nip; ?>" <?php if($get->nip==$value->nip ) echo "selected"; ?>>
                                	<?php echo $value->nama_pegawai ?></option>
                            <?php endforeach;?>
						</select>
						<p class="help-block"><?php echo form_error('nip', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
                    <label for="nama" class="control-label col-md-3 col-xs-12">Nama Diklat : 
                        <strong class="text-red">*</strong>
                    </label>
                    <div class="col-md-8">
                    <input type="text"  class="form-control" name="nama" value="<?php echo $get->nama ?>" >
                        <p class="help-block"><?php echo form_error('nama', '<small class="text-red">', '</small>'); ?></p>            
                    </div>
                </div>
				<div class="form-group">
					<label for="tingkat" class="control-label col-md-3 col-xs-12">Nama Tingkatan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="tingkat" class="form-control">
							<option value="0">-- Pilih Nama Tingkatan --</option>
							<option value="Nasional" <?php if($get->tingkat=='Nasional') echo "selected"; ?>>Nasional</option>
							<option value="Internasional"<?php if($get->tingkat=='Internasional') echo "selected"; ?>>Internasional</option>

						</select>
						<p class="help-block"><?php echo form_error('tingkat', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_mulai" class="control-label col-md-3 col-xs-12">Tanggal Mulai : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
					  	<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					    	<input type="text" class="form-control" name="tgl_mulai" id="datepicker" value="<?php echo $get->tgl_mulai; ?>" placeholder="Ex : 1980-12-31">
					  	</div>
						<p class="help-block"><?php echo form_error('tgl_mulai', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_selesai" class="control-label col-md-3 col-xs-12">Tanggal Selesai : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
					  	<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					    	<input type="text" class="form-control" name="tgl_selesai" id="datepicker" value="<?php echo $get->tgl_selesai; ?>" placeholder="Ex : 1980-12-31">
					  	</div>
						<p class="help-block"><?php echo form_error('tgl_selsai', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="lampiran" class="control-label col-md-3 col-xs-12">Lampiran : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="file" name="foto" class="form-control" value="<?php echo $get->lampiran; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="keterangan" class="control-label col-md-3">Keterangan : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<textarea name="keterangan" rows="8" class="form-control"><?php echo $get->keterangan; ?></textarea>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('diklat') ?>" class="btn btn-app pull-right">
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