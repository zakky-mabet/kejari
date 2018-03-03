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
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mspdp->get($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIUBAH</th>
						<td class="small">
							<?php if ($this->mspdp->get($param)->tanggal_update == NULL): ?>
								<i>Belum ada perubahan</i>
							<?php else: ?>
								<?php echo date_id($this->mspdp->get($param)->tanggal_update) ?>
							<?php endif ?>
						</td>
					</tr>
					
					<tr>
						<th class="small">PENJABAT PEMBUAT</th>
						<td class="small"><?php echo $this->mspdp->get_by_id($this->mspdp->get($param)->user_id)->nip.' - '.$this->mspdp->get_by_id($this->mspdp->get($param)->user_id)->first_name.' '.$this->mspdp->get_by_id($this->mspdp->get($param)->user_id)->last_name ?> </td>
					</tr>
					
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8  col-xs-12">
		<div class="box box-primary">
<?php  
echo form_open(current_url(), array('class' => ''));
echo form_hidden('ID', $param);
?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
                    <label for="nomor" class="control-label">Nomor : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo $this->mspdp->get($param)->nomor ?>">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
               <div class="form-group">
                    <label for="asal" class="control-label">Asal : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control"  name="asal" value="<?php echo $this->mspdp->get($param)->asal ?>">
                        <p class="help-block"><?php echo form_error('asal', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="control-label">Deskripsi : <strong class="text-red">*</strong></label>
                   	<textarea name="deskripsi" rows="8" class="form-control "><?php echo $this->mspdp->get($param)->deskripsi ?></textarea>
                        <p class="help-block"><?php echo form_error('deskripsi', '<small class="text-red">', '</small>'); ?></p>            
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