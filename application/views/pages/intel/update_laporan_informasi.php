<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>

	<div class="col-md-4 col-xs-12">
		<div class="box box-primary">
			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA LAPORAN INFORMASI</th>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mlaporan_informasi->get($param)->tanggal_create) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mlaporan_informasi->get($param)->tanggal_update == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mlaporan_informasi->get($param)->tanggal_update) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">KATEGORI</th>
						<td class="small"><?php echo $this->mlaporan_informasi->get($param)->kategori ?></td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mlaporan_informasi->get_by_id($this->mlaporan_informasi->get($param)->id_user)->nip.' - '.$this->mlaporan_informasi->get_by_id($this->mlaporan_informasi->get($param)->id_user)->first_name.' '.$this->mlaporan_informasi->get_by_id($this->mlaporan_informasi->get($param)->id_user)->last_name ?> </td>
					</tr>
					
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-xs-12">
		<div class="box box-primary">
<?php  
echo form_open(current_url(), array('class' => ''));
echo form_hidden('ID', $param);
?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
                    <label for="nomor" class="control-label">Nomor : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo $this->mlaporan_informasi->get($param)->nomor ?>" placeholder="Tulis Nomor di sini">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="informasi_diperoleh" class="control-label">Informasi yang diperoleh : <strong class="text-red">*</strong></label>
                   	<textarea name="informasi_diperoleh" rows="8" placeholder="Tulis Informasi yang diperoleh di sini" class="form-control textarea"><?php echo $this->mlaporan_informasi->get($param)->informasi_diperoleh ?></textarea>
                        <p class="help-block"><?php echo form_error('informasi_diperoleh', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="sumber_informasi" class="control-label">Sumber Informasi : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" placeholder="Tulis Sumber Informasi di sini" name="sumber_informasi" value="<?php echo $this->mlaporan_informasi->get($param)->sumber_informasi ?>" >
                        <p class="help-block"><?php echo form_error('sumber_informasi', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="trend_perkembangan" class="control-label">Trend Perkembangan / Perkiraan : <strong class="text-red">*</strong></label>
                   	<textarea name="trend_perkembangan" placeholder="Tulis Trend Perkembangan / Perkiraan di sini" rows="8" class="form-control textarea"><?php echo $this->mlaporan_informasi->get($param)->trend_perkembangan ?></textarea>
                        <p class="help-block"><?php echo form_error('trend_perkembangan', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="saran_tindak" class="control-label">Pendapat / Saran / Tindak : <strong class="text-red">*</strong></label>
                   	<textarea name="saran_tindak" rows="8" placeholder="Tulis Pendapat / Saran / Tindak di sini" class="form-control textarea"><?php echo $this->mlaporan_informasi->get($param)->saran_tindak ?></textarea>
                        <p class="help-block"><?php echo form_error('saran_tindak', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
					<label for="kategori" class="control-label">Kategori : <strong class="text-red">*</strong></label>
					<select name="kategori" class="form-control">
						<option value="">-- PILIH --</option>
						<option value="Informasi Harian" <?php if($this->mlaporan_informasi->get($param)->kategori=='Informasi Harian') echo "selected"; ?>>Informasi Harian</option>
				       	<option value="Informasi Khusus" <?php if($this->mlaporan_informasi->get($param)->kategori=='Informasi Khusus') echo "selected"; ?>>Informasi Khusus</option>
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