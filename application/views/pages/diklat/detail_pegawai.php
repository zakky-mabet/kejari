<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="row">
    <div class="col-md-4">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="profile-user-img img-responsive img-circle">
				<?php if ($kepegawaian->foto != FALSE ) : ?>
	              <img width="100%" src="<?php echo base_url('public/images/pegawai/'.$kepegawaian->foto) ?>" class="img-circle" alt="User Image">
	          	<?php else : ?>
	          	  <img width="100%" src="<?php echo base_url('public/images/users/default.png') ?>" class="img-circle" alt="User Image">
	          	<?php endif ?>
	        	</div>
        		<br>
				
				<h3 class="profile-username text-center"><?php echo ucwords($kepegawaian->nama_pegawai) ?></h3>

				<p class="text text-center"></p>

					<table class="table" style="font-family: arial;">
						<tbody>
							<tr>
								<th class="small text-right">NIP :</th>
								<td class="small"><?php echo $kepegawaian->nip ?></td>
							</tr>
							<tr>
								<th width="160" class="small text-right">NRP :</th>
								<td class="small"><?php echo $kepegawaian->nrp ?></td>
							</tr>
							<tr>
								<th class="small text-right">Tempat, Tanggal Lahir :</th>
								<td class="small"><?php echo ucwords($kepegawaian->tempat_lahir).','. date_id($kepegawaian->tgl_lahir) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Jenis Kelamin :</th>
								<td class="small"><?php echo ucwords($kepegawaian->jns_kelamin) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Alamat :</th>
								<td class="small"><?php echo ucwords($kepegawaian->alamat) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Agama :</th>
								<td class="small"><?php echo ucwords($kepegawaian->agama) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Pendidikan Terakhir :</th>
								<td class="small"><?php echo ucwords($kepegawaian->pendidikan_terakhir) ?></td>
							</tr>
						</tbody>
					</table>
				<br>
				<a href="<?php echo site_url('diklat') ?>" class="btn btn-app"><i class="ion ion-reply"></i> Kembali</a>
			</div>
		</div>

    </div>

    <div class="col-md-8 pull-right">
      <div class="nav-tabs-custom">
        <div class="box-body">
	      <table class="table table-bordered table-stripped">
					<thead class="bg-green">
						<tr>
							<th width="20px" class="text-center">No</th>
							<th width="100px" class="text-center">NAMA DIKLAT</th>
							<th width="150px" class="text-center">TANGGAL MULAI</th>
							<th width="150px" class="text-center">TANGGAL SELESAI</th>
							<th width="100px" class="text-center">TINGKAT</th>
							<th>KETERANGAN</th>
							<th width="100px" class="text-center">LAMPIRAN</th>
							<th></th>
						</tr>

					</thead>
					<tbody class="hoverTable">
						<?php foreach($this->db->get_where('riwayat_diklat', array('nip' => $kepegawaian->nip))->result() as $row) : ?>
						<tr>
							<td class="text-center" style="vertical-align: middle;"><?php echo ++$this->page ?>.</td>
							<td class="text-center" style="vertical-align: middle;"><?php echo $row->nama ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php echo date_id($row->tgl_mulai) ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php echo date_id($row->tgl_selesai) ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php echo $row->tingkat ?></td>
							<td style="vertical-align: middle;"><?php echo $row->keterangan ?></td>
							<td>
							<?php if ($row->lampiran != FALSE) :  ?>
							<button  class="btn" id="lihat-gambar" data-src="<?php echo base_url('public/diklat-file/images/'.$row->lampiran) ?>">
							 <img width="100%" src="<?php echo base_url('public/diklat-file/images/'.$row->lampiran) ?>" class="img-rounded" alt="User Image">
							</button>
							<?php else : ?>
							<span data-toggle="tooltip" data-placement="top" class="label label-warning">Lampiran SK Kosong</span>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
        </div>
      </div>
    </div>
</div>
<script>
	$('button#lihat-gambar').unbind().click(function(argument) {
		$('div#exampleModalCenter').modal('show');
		$('img#setImage').attr('src', $(this).data('src'))
	})
</script>
<!-- Modal Gambar -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">    
	<img width="100%" src="" id="setImage" class="img-rounded" alt="User Image">
  </div>
</div>
<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */