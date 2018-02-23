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
						<td class="small"><?php echo $this->mperkara->get_update_telaah($get->id_terusan_disposisi)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL MASUK</th>
						<td class="small"><?php echo date_id($this->mperkara->get_update_telaah($get->id_terusan_disposisi)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mperkara->get_update_telaah($get->id_terusan_disposisi)->asal ?></td>
					</tr>
					<tr>
						<th class="small">PRIHAL</th>
						<td class="small"><?php echo $this->mperkara->get_update_telaah($get->id_terusan_disposisi)->deskripsi ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA INSTRUKSI</th>
					</tr>
					<tr>
						<th class="small">INSTRUKSI KAJARI</th>
						<td class="small"><?php echo $this->mperkara->get_update_telaah($get->id_terusan_disposisi)->instruksi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DI INSTRUKSIKAN</th>
						<td class="small"><?php echo date_id(substr($this->mperkara->get_update_telaah($get->id_terusan_disposisi)->tanggal_disposisi_masuk,0,10)) ?></td>
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
                	<label>Nomor : <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control" autofocus name="no_telaah" value="<?php echo $get->no_telaah ?>" >
                        <p class="help-block"><?php echo form_error('no_telaah', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

              	<div class="form-group">
                	<label>Pokok Permasalahan : <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control"  name="pokok_permasalahan" value="<?php echo $get->pokok_permasalahan ?>" >
                        <p class="help-block"><?php echo form_error('pokok_permasalahan', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

				<div class="form-group">
                	<label>Uraian Permasalahan : <strong class="text-red">*</strong></label>
                	<textarea name="uraian_permasalahan" rows="8"  placeholder="Tulis Uraian Permasalahan di sini." class=" form-control"><?php echo $get->uraian_permasalahan ?></textarea>
					<p class="help-block"><?php echo form_error('uraian_permasalahan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Telaahan : <strong class="text-red">*</strong></label>
                	<textarea name="telaahan" rows="5" class=" form-control"><?php echo $get->telaahan ?></textarea>
					<p class="help-block"><?php echo form_error('telaahan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Kesimpulan : <strong class="text-red">*</strong></label>
                	<textarea name="kesimpulan" rows="4"   class=" form-control"><?php echo $get->kesimpulan ?></textarea>
					<p class="help-block"><?php echo form_error('kesimpulan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Saran Tindak : <strong class="text-red">*</strong></label>
                	<textarea name="saran_tindak" rows="4" class=" form-control"><?php echo $get->saran_tindak ?></textarea>
					<p class="help-block"><?php echo form_error('saran_tindak', '<small class="text-red">', '</small>'); ?></p>
              	</div>

       				
				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('perkara') ?>" class="btn btn-app pull-right">
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