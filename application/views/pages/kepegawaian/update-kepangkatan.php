<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$get = $this->db->get_where('kepegawaian', array('nip'=> $pangkat->nip))->row();
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
    <div class="col-md-4">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="text-center pull-left image">
			 <?php if($get->foto != FALSE) : ?>
	              <img width="60%" src="<?php echo base_url('public/images/pegawai/'.$get->foto) ?>" class="img-circle" alt="User Image">
	          <?php else : ?>
	          	  <img width="60%" src="<?php echo base_url('public/images/users/default.png') ?>" class="img-circle" alt="User Image">
	          <?php endif; ?>
	        	</div>
        	<br>
				<h3 class="profile-username text-center"><?php echo ucwords($get->nama) ?></h3>
				<p class="text-muted text-center"></p>
				    <table class="table" style="font-family: arial;">
						<tbody>
							<tr>
								<th class=" text-right">NIP :</th>
								<td><?php echo $get->nip ?></td>
							</tr>
							<tr>
								<th width="160" class=" text-right">NRP :</th>
								<td><?php echo $get->nrp ?></td>
							</tr>
							<tr>
								<th class=" text-right">Tempat, Tanggal Lahir :</th>
								<td><?php echo ucwords($get->tempat_lahir).','. date_id($get->tgl_lahir) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Jenis Kelamin :</th>
								<td><?php echo ucwords($get->jns_kelamin) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Alamat :</th>
								<td><?php echo ucwords($get->alamat) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Agama :</th>
								<td><?php echo ucwords($get->agama) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Pendidikan Terakhir :</th>
								<td><?php echo ucwords($get->pendidikan_terakhir) ?></td>
							</tr>
						</tbody>
					</table>
			</div>
		</div>
    </div>


	
	<div class="col-md-8  col-xs-12" >
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open_multipart(current_url(), array('class' => 'form-horizontal'));
?>
			<div class="box-body">
				<div class="form-group">
					<div class="col-md-8">
						<input type="hidden" name="nip" class="form-control" value="<?php echo $pangkat->nip ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">TMT : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="date" id="datepicker" class="form-control" value="<?php echo $pangkat->tmt ?>">
						<p class="help-block"><?php echo form_error('date', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>

				<div class="form-group">
					<label for="pangkat" class="control-label col-md-3 col-xs-12">Pangkat : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="pangkat" class="form-control" value="<?php echo $pangkat->pangkat ?>">
						<p class="help-block"><?php echo form_error('pangkat', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="no_sk" class="control-label col-md-3 col-xs-12">Nomor SK : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="no_sk" class="form-control" value="<?php echo $pangkat->no_sk ?>">
						<p class="help-block"><?php echo form_error('no_sk', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Lampiran SK : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="file" name="foto" class="form-control" value="<?php echo $pangkat->lampiran_sk ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="golongan" class="control-label col-md-3 col-xs-12">Golongan : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="golongan" class="form-control" value="<?php echo $pangkat->golongan ?>">
						<p class="help-block"><?php echo form_error('golongan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="ruang" class="control-label col-md-3 col-xs-12">Ruang : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="ruang" class="form-control" value="<?php echo $pangkat->ruang ?>">
						<p class="help-block"><?php echo form_error('ruang', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="alamat" class="control-label col-md-3">Keterangan : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<textarea name="keterangan" rows="3" class="form-control"><?php echo $pangkat->keterangan ?></textarea>
						<p class="help-block"><?php echo form_error('keterangan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('kepangkatan/detail_kepangkatan/'.$get->ID) ?>" class="btn btn-app pull-right">
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
// End Form
echo form_close();
?>
		</div>
	</div>
</div>

<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */