<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-4">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="text-center pull-left image">
	              <img width="60%" src="<?php echo base_url('public/images/pegawai/'.$kepegawaian->foto) ?>" class="img-circle" alt="User Image">
	        	</div>
        		<br>
        		<br>
				<h3 class="profile-username text-center"><?php echo ucwords($kepegawaian->nama_pegawai) ?></h3>
				<p class="text-muted text-center"></p>
				    <table class="table" style="font-family: arial;">
						<tbody>
							<tr>
								<th class=" text-right">NIP :</th>
								<td><?php echo $kepegawaian->nip ?></td>
							</tr>
							<tr>
								<th width="160" class=" text-right">NRP :</th>
								<td><?php echo $kepegawaian->nrp ?></td>
							</tr>
							<tr>
								<th class=" text-right">Tempat, Tanggal Lahir :</th>
								<td><?php echo ucwords($kepegawaian->tempat_lahir).','. date_id($kepegawaian->tgl_lahir) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Jenis Kelamin :</th>
								<td><?php echo ucwords($kepegawaian->jns_kelamin) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Alamat :</th>
								<td><?php echo ucwords($kepegawaian->alamat) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Agama :</th>
								<td><?php echo ucwords($kepegawaian->agama) ?></td>
							</tr>
							<tr>
								<th class=" text-right">Pendidikan Terakhir :</th>
								<td><?php echo ucwords($kepegawaian->pendidikan_terakhir) ?></td>
							</tr>
						</tbody>
					</table>
				<hr>
				<a href="<?php echo site_url('diklat') ?>" class="btn btn-app">
						<i class="ion ion-reply"></i> Kembali
				</a>
			</div>
		</div>

    </div>

    <div class="col-md-8 pull-right">
      <div class="nav-tabs-custom">
        <div class="tab-content">
	      <table class="table table-bordered table-stripped">
					<thead class="bg-green">
						<tr>
							<th width="50px" class="text-center">No</th>
							<th width="100px" class="text-center">Nama Diklat</th>
							<th width="100px" class="text-center">Tanggal Mulai</th>
							<th width="100px" class="text-center">Tanggal Selesai</th>
							<th width="100px" class="text-center">Tingkat</th>
							<th width="100px" class="text-center">Lampiran</th>
						</tr>

					</thead>
					<tbody>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td class="text-center"><?php echo $kepegawaian->nama ?></td>
							<td class="text-center"><?php echo date_id($kepegawaian->tgl_mulai) ?></td>
							<td class="text-center"><?php echo date_id($kepegawaian->tgl_selesai) ?></td>
							<td class="text-center"><?php echo $kepegawaian->tingkat ?></td>
							
							<td class="text-center pull-left image">
								<button data-toggle="modal" data-target="#exampleModalCenter">
					         		<img width="100%" src="<?php echo base_url('public/diklat-file/'.$kepegawaian->lampiran) ?>"
					         		 class="img-rounded" alt="User Image">
					         	</button>
					        </td>
						</tr>
					</tbody>
				</table>
        </div>
      </div>
    </div>
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">    
	<img width="100%" src="<?php echo base_url('public/diklat-file/'.$kepegawaian->lampiran) ?>" class="img-rounded" alt="User Image">
  </div>
</div>
<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */