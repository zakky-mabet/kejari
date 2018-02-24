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
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL MASUK</th>
						<td class="small"><?php echo date_id($this->mperintah_op->get_in_create($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">PRIHAL</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->deskripsi ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA INSTRUKSI</th>
					</tr>
					<tr>
						<th class="small">INSTRUKSI KAJARI</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->instruksi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DI INSTRUKSIKAN</th>
						<td class="small"><?php echo date_id(substr($this->mperintah_op->get_in_create($param)->tanggal_disposisi_masuk,0,10)) ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA TELAAHAN INTELIJEN</th>
					</tr>
					<tr >
						<th class="small">NOMOR TELAAH</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->no_telaah ?></td>
					</tr>
					<tr >
						<th class="small">POKOK PERMASALAHAN</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->pokok_permasalahan ?></td>
					</tr>
					<tr >
						<th class="small">URAIAN PERMASALAHAN</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->uraian_permasalahan ?></td>
					</tr>
					<tr >
						<th class="small">TELAAHAN</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->telaahan ?></td>
					</ tr>
					<tr >
						<th class="small">KESIMPULAN</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->kesimpulan ?></td>
					</tr>
					<tr >
						<th class="small">SARAN TINDAK</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->saran_tindak ?></td>
					</tr>
					<tr >
						<th class="small">PEMBUAT TELAAHAN</th>
						<td class="small"><?php echo  $this->mperintah_op->get_by_id($this->mperintah_op->get_in_create($param)->id_user_pembuat_telaah)->nip.' - '.$this->mperintah_op->get_by_id($this->mperintah_op->get_in_create($param)->id_user_pembuat_telaah)->first_name.' '.$this->mperintah_op->get_by_id($this->mperintah_op->get_in_create($param)->id_user_pembuat_telaah)->last_name ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DI TELAAH</th>
						<td class="small"><?php echo date_id(substr($this->mperintah_op->get_in_create($param)->tanggal_di_telaah,0,10)) ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA PETUNJUK KAJARI</th>
					</tr>
					
					<tr >
						<th class="small">PETUNJUK</th>
						<td class="small"><?php echo $this->mperintah_op->get_in_create($param)->petunjuk ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL </th>
						<td class="small"><?php echo date_id(substr($this->mperintah_op->get_in_create($param)->tanggal_petunjuk,0,10)) ?></td>
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
                	<label>Nomor Perintah Operasi: <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control" autofocus name="nomor_prinops" value="<?php echo $this->mperintah_op->get_in_create($param)->nomor_prinops ?>" >
                        <p class="help-block"><?php echo form_error('nomor_prinops', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

				<div class="form-group">
                	<label>Untuk  : <strong class="text-red">*</strong></label>
                	<textarea name="deskripsi_untuk" rows="8"  placeholder="Tulis Uraian Permasalahan di sini." class=" form-control"><?php echo $this->mperintah_op->get_in_create($param)->deskripsi_untuk ?></textarea>
					<p class="help-block"><?php echo form_error('deskripsi_untuk', '<small class="text-red">', '</small>'); ?></p>
              	</div>
       			
       			<div class="form-group">
					<label> Kepada : <strong class="text-red">*</strong> </label>
					<?php foreach ($this->mperintah_op->get_group(4) as $key => $value): ?>
						<p><input type="checkbox" name="id_user[]" value="<?php echo $value->id ?>" class="minimal" >  <?php echo $value->nip.' - '.$value->first_name.' '.$value->last_name ?> </p>
					<?php endforeach ?>
					<input type="hidden" name="id_user[]" checked="checked" value="1" class="minimal" >
					<p class="help-block"><?php echo form_error('id_user[]', '<small class="text-red">', '</small>'); ?></p>
				</div>

				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('perintah_op') ?>" class="btn btn-app pull-right">
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