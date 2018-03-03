<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-4 col-xs-12">
		<div class="box box-primary">
			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA SPDP</th>
					</tr>
					<tr>
						<th class="small">NOMOR</th>
						<td class="small"><?php echo $this->mp16->get($param)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mp16->get($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">DESKRIPSI</th>
						<td class="small"><?php echo $this->mp16->get($param)->deskripsi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp16->get($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp16->get($param)->tanggal_update == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp16->get($param)->tanggal_update) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp16->get_by_id($this->mp16->get($param)->user_id)->nip.' - '.$this->mp16->get_by_id($this->mp16->get($param)->user_id)->first_name.' '.$this->mp16->get_by_id($this->mp16->get($param)->user_id)->last_name ?> </td>
					</tr>
					
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8  col-xs-12">
		<div class="box box-primary">
<?php  
echo form_open(current_url(), array('class' => ''));

?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
                    <label for="nomor_print" class="control-label">NOMOR PRINT : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor_print" value="<?php echo  $this->mp16->get($param)->nomor_print ?>">
                        <p class="help-block"><?php echo form_error('nomor_print', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="dasar" class="control-label">DASAR : <strong class="text-red">*</strong></label>
                   	<textarea name="dasar" rows="8" class="form-control textarea"><?php echo  $this->mp16->get($param)->dasar ?></textarea>
                        <p class="help-block"><?php echo form_error('dasar', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="pertimbangan" class="control-label">PERTIMBANGAN : <strong class="text-red">*</strong></label>
                   	<textarea name="pertimbangan" rows="8" class="form-control textarea"><?php  echo $this->mp16->get($param)->pertimbangan ?></textarea>
                        <p class="help-block"><?php echo form_error('pertimbangan', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="untuk" class="control-label">UNTUK : <strong class="text-red">*</strong></label>
                   	<textarea name="untuk" rows="8" class="form-control textarea"><?php  echo $this->mp16->get($param)->untuk ?></textarea>
                        <p class="help-block"><?php echo form_error('untuk', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
					<label> MEMERINTAHKAN KEPADA : <strong class="text-red">*</strong> </label>
					<?php foreach ($this->mperintah_op->get_group(6) as $key => $value): ?>
						<p><input type="checkbox" name="id_user[]" value="<?php echo $value->id ?>" <?php echo set_checkbox('id_user[]', $value->id ); ?> class="minimal" >  <?php echo $value->nip.' - '.$value->first_name.' '.$value->last_name ?> </p>
					<?php endforeach ?>
					<input type="hidden" name="id_user[]" checked="checked" value="1"  class="minimal" >
					<p class="help-block"><?php echo form_error('id_user[]', '<small class="text-red">', '</small>'); ?></p>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('spdp') ?>" class="btn btn-app pull-right">
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
echo form_close();
?>
		</div>
	</div>
</div>