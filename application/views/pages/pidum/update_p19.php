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
						<td class="small"><?php echo $this->mp19->get_on_update($param)->nomor_spdp ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">DESKRIPSI</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->deskripsi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp19->get_on_update($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp19->get_on_update($param)->tanggal_update_spdp == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp19->get_on_update($param)->tanggal_update_spdp) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp19->get_by_id($this->mp19->get_on_update($param)->user_id)->nip.' - '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->user_id)->first_name.' '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->user_id)->last_name ?> </td>
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
						<td class="small"><?php echo $this->mp19->get_on_update($param)->nomor_print ?></td>
					</tr>
					<tr>
						<th class="small">DASAR</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->dasar ?></td>
					</tr>
					<tr>
						<th class="small">PERTIMBANGAN</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->pertimbangan ?></td>
					</tr>
					<tr>
						<th class="small">UNTUK</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->untuk ?></td>
					</tr>
					<tr>
						<th class="small">DASAR</th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->dasar ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp19->get_on_update($param)->tanggal_create) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp19->get_on_update($param)->tanggal_update_p16 == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp19->get_on_update($param)->tanggal_update_p16) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p16)->nip.' - '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p16)->first_name.' '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p16)->last_name ?> </td>
					</tr>

				</table>
			</div>

			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA P-17</th>
					</tr>
					<tr>
						<th class="small">NOMOR </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->nomor_p17 ?></td>
					</tr>
					<tr>
						<th class="small">SIFAT </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->sifat ?></td>
					</tr>
					<tr>
						<th class="small">PERIHAL </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->perihal ?></td>
					</tr>
					<tr>
						<th class="small">KEPADA </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->dikirim_kepada ?></td>
					</tr>
					<tr>
						<th class="small">TEMPAT </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->ditempat ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp19->get_on_update($param)->tanggal_create_p17) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp19->get_on_update($param)->tanggal_update_p17 == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp19->get_on_update($param)->tanggal_update_p17) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p17)->nip.' - '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p17)->first_name.' '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p17)->last_name ?> </td>
					</tr>
					
				</table>
			</div>

			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA P-18</th>
					</tr>
					<tr>
						<th class="small">NOMOR </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->nomor_p18 ?></td>
					</tr>
					<tr>
						<th class="small">SIFAT </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->sifat_p18 ?></td>
					</tr>
					<tr>
						<th class="small">PERIHAL </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->perihal_p18 ?></td>
					</tr>
					<tr>
						<th class="small">KEPADA </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->dikirim_kepada_p18 ?></td>
					</tr>
					<tr>
						<th class="small">TEMPAT </th>
						<td class="small"><?php echo $this->mp19->get_on_update($param)->ditempat_p18 ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mp19->get_on_update($param)->tanggal_create_p18) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mp19->get_on_update($param)->tanggal_update_p18 == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mp19->get_on_update($param)->tanggal_update_p18) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p18)->nip.' - '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p18)->first_name.' '.$this->mp19->get_by_id($this->mp19->get_on_update($param)->id_user_p18)->last_name ?> </td>
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
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo $this->mp19->get_on_update($param)->nomor_p19 ?>">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="sifat" class="control-label">SIFAT : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="sifat" value="<?php echo $this->mp19->get_on_update($param)->sifat_p19 ?>">
                        <p class="help-block"><?php echo form_error('sifat', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="perihal" class="control-label">PERIHAL : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="perihal" value="<?php echo $this->mp19->get_on_update($param)->perihal_p19 ?>">
                        <p class="help-block"><?php echo form_error('perihal', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="dikirim_kepada" class="control-label">KEPADA : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="dikirim_kepada" value="<?php echo $this->mp19->get_on_update($param)->dikirim_kepada ?>">
                        <p class="help-block"><?php echo form_error('dikirim_kepada', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="ditempat" class="control-label">TEMPAT : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" name="ditempat" value="<?php echo $this->mp19->get_on_update($param)->ditempat_p19 ?>">
                        <p class="help-block"><?php echo form_error('ditempat', '<small class="text-red">', '</small>'); ?></p>            
                </div>

			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('p19') ?>" class="btn btn-app pull-right">
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