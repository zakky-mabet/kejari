<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-primary">
<?php  
echo form_open(current_url(), array('class' => ''));
?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
                    <label for="nomor" class="control-label">Nomor : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo set_value('nomor') ?>" placeholder="Tulis Nomor di sini">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="informasi_diperoleh" class="control-label">Informasi yang diperoleh : <strong class="text-red">*</strong></label>
                   	<textarea name="informasi_diperoleh" rows="8" placeholder="Tulis Informasi yang diperoleh di sini" class="form-control textarea"><?php echo set_value('informasi_diperoleh') ?></textarea>
                        <p class="help-block"><?php echo form_error('informasi_diperoleh', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="sumber_informasi" class="control-label">Sumber Informasi : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" placeholder="Tulis Sumber Informasi di sini" name="sumber_informasi" value="<?php echo set_value('sumber_informasi') ?>" >
                        <p class="help-block"><?php echo form_error('sumber_informasi', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="trend_perkembangan" class="control-label">Trend Perkembangan / Perkiraan : <strong class="text-red">*</strong></label>
                   	<textarea name="trend_perkembangan" placeholder="Tulis Trend Perkembangan / Perkiraan di sini" rows="8" class="form-control textarea"><?php echo set_value('trend_perkembangan') ?></textarea>
                        <p class="help-block"><?php echo form_error('trend_perkembangan', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="saran_tindak" class="control-label">Pendapat / Saran / Tindak : <strong class="text-red">*</strong></label>
                   	<textarea name="saran_tindak" rows="8" placeholder="Tulis Pendapat / Saran / Tindak di sini" class="form-control textarea"><?php echo set_value('saran_tindak') ?></textarea>
                        <p class="help-block"><?php echo form_error('saran_tindak', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
					<label for="kategori" class="control-label">Kategori : <strong class="text-red">*</strong></label>
					<select name="kategori" class="form-control">
						<option value="">-- PILIH --</option>
						<option value="Informasi Harian" <?php echo set_select('kategori', 'Informasi Harian'); ?>>Informasi Harian</option>
				       	<option value="Informasi Khusus" <?php echo set_select('kategori', 'Informasi Khusus'); ?>>Informasi Khusus</option>
					</select>
					<p class="help-block"><?php echo form_error('kategori', '<small class="text-red">', '</small>'); ?></p>
				</div>
				<div class="form-group">
					<label>Kirim Kepada : <strong class="text-red">*</strong> </label>
						<?php foreach ($this->mperintah_op->get_all_user() as $key => $value): ?>
							<p><input type="checkbox" name="id_user[]" value="<?php echo $value->id ?>" <?php echo set_checkbox('id_user[]', $value->id ); ?> class="minimal">  <?php echo $value->nip.' - '.$value->first_name.' '.$value->last_name ?> </p>
						<?php endforeach ?>
					<p class="help-block"><?php echo form_error('id_user[]', '<small class="text-red">', '</small>'); ?></p>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					
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
echo form_close();
?>
		</div>
	</div>
</div>