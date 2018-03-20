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
						<th class="small">NOMOR </th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">DESKRIPSI</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->deskripsi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp17->get_update_p17($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp17->get_update_p17($param)->tanggal_update_spdp == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp17->get_update_p17($param)->tanggal_update_spdp) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp17->get_by_id($this->mp17->get_update_p17($param)->user_id)->nip.' - '.$this->mp17->get_by_id($this->mp17->get_update_p17($param)->user_id)->first_name.' '.$this->mp17->get_by_id($this->mp17->get_update_p17($param)->user_id)->last_name ?> </td>
					</tr>
					
				</table>
			</div>

			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA P-16</th>
					</tr>
					<tr>
						<th class="small">NOMOR PRINT</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->nomor_print ?></td>
					</tr>
					<tr>
						<th class="small">DASAR</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->dasar ?></td>
					</tr>
					<tr>
						<th class="small">PERTIMBANGAN</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->pertimbangan ?></td>
					</tr>
					<tr>
						<th class="small">UNTUK</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->untuk ?></td>
					</tr>
					<tr>
						<th class="small">DASAR</th>
						<td class="small"><?php echo $this->mp17->get_update_p17($param)->dasar ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp17->get_update_p17($param)->tanggal_create) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp17->get_update_p17($param)->tanggal_update_p16 == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp17->get_update_p17($param)->tanggal_update_p16) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp17->get_by_id($this->mp17->get_update_p17($param)->id_user_p16)->nip.' - '.$this->mp17->get_by_id($this->mp17->get_update_p17($param)->id_user_p16)->first_name.' '.$this->mp17->get_by_id($this->mp17->get_update_p17($param)->id_user_p16)->last_name ?> </td>
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
                    <label for="nomor" class="control-label">NOMOR : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo $this->mp17->get_update_p17($param)->nomor_p17 ?>">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="sifat" class="control-label">SIFAT : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="sifat" value="<?php echo $this->mp17->get_update_p17($param)->sifat ?>">
                        <p class="help-block"><?php echo form_error('sifat', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="perihal" class="control-label">PERIHAL : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="perihal" value="<?php echo $this->mp17->get_update_p17($param)->perihal ?>">
                        <p class="help-block"><?php echo form_error('perihal', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="dikirim_kepada" class="control-label">KEPADA : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="dikirim_kepada" value="<?php echo $this->mp17->get_update_p17($param)->dikirim_kepada ?>">
                        <p class="help-block"><?php echo form_error('dikirim_kepada', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="ditempat" class="control-label">TEMPAT : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="ditempat" value="<?php echo $this->mp17->get_update_p17($param)->ditempat ?>">
                        <p class="help-block"><?php echo form_error('ditempat', '<small class="text-red">', '</small>'); ?></p>            
                </div>

			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('p17') ?>" class="btn btn-app pull-right">
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