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
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->nomor ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL MASUK</th>
						<td class="small"><?php echo date_id($this->mlapopsin->get_in_create($param)->tanggal_masuk) ?></td>
					</tr>
					<tr>
						<th class="small">ASAL</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->asal ?></td>
					</tr>
					<tr>
						<th class="small">PRIHAL</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->deskripsi ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA INSTRUKSI KAJARI</th>
					</tr>
					<tr>
						<th class="small">INSTRUKSI </th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->instruksi ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DI INSTRUKSIKAN</th>
						<td class="small"><?php echo date_id(substr($this->mlapopsin->get_in_create($param)->tanggal_disposisi_masuk,0,10)) ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA TELAAHAN INTELIJEN</th>
					</tr>
					<tr >
						<th class="small">NOMOR TELAAH</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->no_telaah ?></td>
					</tr>
					<tr >
						<th class="small">POKOK PERMASALAHAN</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->pokok_permasalahan ?></td>
					</tr>
					<tr >
						<th class="small">URAIAN PERMASALAHAN</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->uraian_permasalahan ?></td>
					</tr>
					<tr >
						<th class="small">TELAAHAN</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->telaahan_telaah ?></td>
					</ tr>
					<tr >
						<th class="small">KESIMPULAN</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->kesimpulan_telaah ?></td>
					</tr>
					<tr >
						<th class="small">SARAN TINDAK</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->saran_tindak_telaah ?></td>
					</tr>
					<tr >
						<th class="small">PEMBUAT TELAAHAN</th>
						<td class="small"><?php echo  $this->mlapopsin->get_by_id($this->mlapopsin->get_in_create($param)->id_user_pembuat_telaah)->nip.' - '.$this->mlapopsin->get_by_id($this->mlapopsin->get_in_create($param)->id_user_pembuat_telaah)->first_name.' '.$this->mlapopsin->get_by_id($this->mlapopsin->get_in_create($param)->id_user_pembuat_telaah)->last_name ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL DI TELAAH</th>
						<td class="small"><?php echo date_id(substr($this->mlapopsin->get_in_create($param)->tanggal_di_telaah,0,10)) ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA PETUNJUK KAJARI</th>
					</tr>
					
					<tr >
						<th class="small">PETUNJUK</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->petunjuk ?></td>
					</tr>
					<tr>
						<th class="small">TANGGAL </th>
						<td class="small"><?php echo date_id(substr($this->mlapopsin->get_in_create($param)->tanggal_petunjuk,0,10)) ?></td>
					</tr>
					<tr class="bg-green">
						<th colspan="2" >DATA SURAT PERINTAH OPERASI INTELIJEN</th>
					</tr>
					<tr>
						<th class="small">NOMOR PRINOPS</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->nomor_prinops ?></td>
					</tr>
					<tr>
						<th class="small">UNTUK</th>
						<td class="small"><?php echo $this->mlapopsin->get_in_create($param)->deskripsi_untuk ?></td>
					</tr>
					<tr>
						<th class="small">DIPERINTAH KEPADA</th>
						<td class="small">

							<?php foreach ($this->mlapopsin->get_kepada($this->mlapopsin->get_in_create($param)->ID_primary_perintah_op) as $key => $value): ?>
								<p><?php echo $this->mlapopsin->get_by_id($value->id_user)->nip ?> - <?php echo $this->mlapopsin->get_by_id($value->id_user)->first_name ?> <?php echo $this->mlapopsin->get_by_id($value->id_user)->last_name ?></p>
							<?php endforeach ?> 

						</td>
					</tr>
					<tr>
						<th class="small">TANGGAL DIBUAT</th>
						<td class="small"><?php echo date_id($this->mlapopsin->get_in_create($param)->tanggal_dibuat) ?></td>
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
                	<label>Nomor Lapopsin : <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control" autofocus name="nomor_laphosin" value="<?php echo set_value('nomor_laphosin') ?>" >
                        <p class="help-block"><?php echo form_error('nomor_laphosin', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

				<div class="form-group">
                	<label>Dasar  : <strong class="text-red">*</strong></label>
                	<textarea name="dasar" rows="4"  placeholder="Tulis deskripsi dasar di sini." class=" form-control"><?php echo set_value('dasar') ?></textarea>
					<p class="help-block"><?php echo form_error('dasar', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Tugas  : <strong class="text-red">*</strong></label>
                	<textarea name="tugas" rows="4"  placeholder="Tulis deskripsi tugas di sini." class=" form-control"><?php echo set_value('tugas') ?></textarea>
					<p class="help-block"><?php echo form_error('tugas', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Bahan Keterangan : <strong class="text-red">*</strong></label>
                	<textarea name="bahan_keterangan" rows="4"  placeholder="Tulis deskripsi Bahan Keterangan di sini." class=" form-control"><?php echo set_value('bahan_keterangan') ?></textarea>
					<p class="help-block"><?php echo form_error('bahan_keterangan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Data yang diperoleh : <strong class="text-red">*</strong></label>
                	<textarea name="data_diperoleh" rows="4"  placeholder="Tulis data data yang diperoleh di sini." class=" form-control"><?php echo set_value('data_diperoleh') ?></textarea>
					<p class="help-block"><?php echo form_error('data_diperoleh', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Telaahan : <strong class="text-red">*</strong></label>
                	<textarea name="telaahan" rows="4"  placeholder="Tulis data data yang diperoleh di sini." class=" form-control"><?php echo set_value('telaahan') ?></textarea>
					<p class="help-block"><?php echo form_error('telaahan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Kesimpulan : <strong class="text-red">*</strong></label>
                	<textarea name="kesimpulan" rows="4"  placeholder="Tulis data data yang diperoleh di sini." class=" form-control"><?php echo set_value('kesimpulan') ?></textarea>
					<p class="help-block"><?php echo form_error('kesimpulan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Saran Tindak : <strong class="text-red">*</strong></label>
                	<textarea name="saran_tindak" rows="4"  placeholder="Tulis data data yang diperoleh di sini." class=" form-control"><?php echo set_value('saran_tindak') ?></textarea>
					<p class="help-block"><?php echo form_error('saran_tindak', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
					<label>Kirim Kepada : <strong class="text-red">*</strong> </label>
					<?php foreach ($this->mperintah_op->get_group(4) as $key => $value): ?>
						<p><input type="checkbox" name="id_user[]" value="<?php echo $value->id ?>" class="minimal" >  <?php echo $value->nip.' - '.$value->first_name.' '.$value->last_name ?> </p>
					<?php endforeach ?>
					<input type="checkbox" name="id_user[]" checked="checked"  value="1" class="minimal" > <?php echo $this->mlapopsin->get_by_id(1)->nip.' - '.$this->mlapopsin->get_by_id(1)->first_name.' '.$this->mlapopsin->get_by_id(1)->last_name ?>
					<p class="help-block"><?php echo form_error('id_user[]', '<small class="text-red">', '</small>'); ?></p>
				</div>

				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('lapopsin') ?>" class="btn btn-app pull-right">
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