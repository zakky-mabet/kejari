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
					<label for="email" class="control-label col-md-3 col-xs-12">NIP : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<input type="text" name="nip" class="form-control" value="<?php echo $get->nip; ?>">
						<p class="help-block"><?php echo form_error('nip', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">NRP : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<input type="text" name="nrp" class="form-control" value="<?php echo $get->nrp; ?>">
						<p class="help-block"><?php echo form_error('nrp', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nama : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" value="<?php echo $get->nama; ?>">
						<p class="help-block"><?php echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="tmp_lahir" class="control-label col-md-3 col-xs-12">Tempat, Tanggal Lahir : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<input type="text" name="tmp_lahir" class="form-control" value="<?php echo $get->tempat_lahir; ?>">
						<p class="help-block"><?php echo form_error('tmp_lahir', '<small class="text-red">', '</small>'); ?></p>
					</div>
					<div class="col-md-4">
					  	<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					    	<input type="text" class="form-control" name="tgl_lahir" id="datepicker" value="<?php echo $get->tgl_lahir; ?>" placeholder="Ex : 1980-12-31">
					  	</div>
						<p class="help-block"><?php echo form_error('tgl_lahir', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="gender" class="control-label col-md-3">Jenis Kelamin : <strong class="text-red">*</strong></label>
					<div class="col-md-6">
				       	<div class="radio radio-inline radio-primary">
				           <input name="gender" type="radio" value="LAKI-LAKI" <?php if($get->jns_kelamin=='LAKI-LAKI') echo "checked"; ?>> <label for="gender"> Laki-laki</label>
				       	</div>
				       	<div class="radio radio-inline radio-primary">
				           <input name="gender" type="radio" value="PEREMPUAN" <?php if($get->jns_kelamin=='PEREMPUAN') echo "checked"; ?>> <label for="gender"> Perempuan</label>
				       	</div>
				       	<p class="help-block"><?php echo form_error('gender', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="agama" class="control-label col-md-3 col-xs-12">Agama : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<select name="agama" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="islam" <?php if($get->agama =='islam') echo "selected"; ?>>Islam</option>
							<option value="kristen" <?php if($get->agama =='kristen') echo "selected"; ?>>Kristen</option>
							<option value="katholik" <?php if($get->agama =='katholik') echo "selected"; ?>>Katholik</option>
							<option value="hindu" <?php if($get->agama =='hindu') echo "selected"; ?>>Hindu</option>
							<option value="buddha" <?php if($get->agama =='buddha') echo "selected"; ?>>Buddha</option>
							<option value="khonghucu" <?php if($get->agama =='khonghucu') echo "selected"; ?>>Khonghucu</option>
							<option value="aliran kepercayaan" <?php if($get->agama =='aliran kepercayaan') echo "selected"; ?>>Lainnya</option>
						</select>
						<p class="help-block"><?php echo form_error('agama', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="pendidikan_terakhir" class="control-label col-md-3 col-xs-12">Pendidikan Terakhir : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="pendidikan_terakhir" class="form-control" value="<?php echo $get->pendidikan_terakhir; ?>">
						<p class="help-block"><?php echo form_error('pendidikan_terakhir', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="text" class="control-label col-md-3 col-xs-12">Jabatan : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="text" name="jabatan" class="form-control" value="<?php echo $get->jabatan; ?>">
						<p class="help-block"><?php echo form_error('jabatan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="alamat" class="control-label col-md-3">Alamat : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<textarea name="alamat" rows="5" class="form-control"><?php echo $get->alamat; ?></textarea>
						<p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Telepon : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="text" name="telepon" class="form-control" value="<?php echo $get->no_tlp; ?>">
						<p class="help-block"><?php echo form_error('telepon', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Foto : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="status" class="control-label col-md-3">Status Dinas : <strong class="text-red">*</strong></label>
					<div class="col-md-6">
				       	<div class="radio radio-inline radio-primary">
				           <input name="status" type="radio" value="1" <?php if($get->status_dinas =='1') echo "checked"; ?>> <label for="status"> Aktif</label>
				       	</div>
				       	<div class="radio radio-inline radio-primary">
				           <input name="status" type="radio" value="0" <?php if($get->status_dinas =='0') echo "checked"; ?>> <label for="status"> Tidak Aktif</label>
				       	</div>
				       	<p class="help-block"><?php echo form_error('status', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>

				 <div class="form-group">
					<label for="Bidang" class="control-label col-md-3 col-xs-12">Bidang : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<select name="bidang" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="2" <?php if($get->bidang == '2') echo "selected"; ?>>PIDSUS</option>
							<option value="3" <?php if($get->bidang == '3') echo "selected"; ?>>PEMBINAAN</option>
							<option value="4" <?php if($get->bidang == '4') echo "selected"; ?>>INTELEJEN</option>
							<option value="5" <?php if($get->bidang == '5') echo "selected"; ?>>DATUN</option>
							<option value="6" <?php if($get->bidang == '6') echo "selected"; ?>>PIDUM</option>
							<option value="7" <?php if($get->bidang == '7') echo "selected"; ?>>KEJARI</option>
							
						</select>
						<p class="help-block"><?php echo form_error('bidang', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('kepegawaian') ?>" class="btn btn-app pull-right">
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