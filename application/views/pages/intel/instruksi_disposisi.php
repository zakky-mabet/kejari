<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>

	<div class="col-md-4 col-xs-12">
		<div class="box box-primary">
			<div class="box-body" style="margin-top: 10px;">
				<table class="table" >
					<tr class="bg-green">
						<th colspan="2" >DATA LAPORAN MASYARAKAT</th>
					</tr>
					<tr >
						<th class="small" width="40%">NOMOR</th>
						<td class="small"><?php echo $this->mlaporan_masyarakat->get($param)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL MASUK</th>
						<td class="small"><?php echo date_id($this->mlaporan_masyarakat->get($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mlaporan_masyarakat->get($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">PRIHAL</th>
						<td class="small"><?php echo $this->mlaporan_masyarakat->get($param)->deskripsi ?></td>
					</tr>
					
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-xs-12">
		<div class="box box-primary">
			<?php
			echo form_open(current_url(), array('class' => ''));
			?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label>Instruksi : <strong class="text-red">*</strong></label>
					<textarea name="instruksi" rows="8" autofocus placeholder="Tulis Instruksi di sini." class=" form-control"><?php echo set_value('instruksi') ?></textarea>
					<p class="help-block"><?php echo form_error('instruksi', '<small class="text-red">', '</small>'); ?></p>
				</div>
				<div class="form-group">
					<label>Disposisi/ Diteruskan Kepada : <strong class="text-red">*</strong> </label>
					<p><input type="checkbox" name="group_id" value="4" class="minimal" checked >  SEKSI INTELIJEN </p>
					<p><input type="checkbox" class="minimal" disabled="disabled" >  SEKSI PIDSUS </p>
					<p><input type="checkbox" class="minimal" disabled="disabled" >  SEKSI PIDUM </p>
					<p><input type="checkbox" class="minimal" disabled="disabled" >  SEKSI DATUN</p>
					<p class="help-block"><?php echo form_error('group_id', '<small class="text-red">', '</small>'); ?></p>
				</div>
				
				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('laporan_masyarakat/data_laporan') ?>" class="btn btn-app pull-right">
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
</div>