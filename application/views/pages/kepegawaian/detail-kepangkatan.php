<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
    <div class="col-md-4">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="profile-user-img img-responsive img-circle">
			 <?php if($get->foto != FALSE) : ?>
	              <img width="100%" src="<?php echo base_url('public/images/pegawai/'.$get->foto) ?>" class="img-circle" alt="User Image">
	          <?php else : ?>
	          	  <img width="100%" src="<?php echo base_url('public/images/users/default.png') ?>" class="img-circle" alt="User Image">
	          <?php endif; ?>
	        	</div>
        	<br>
				<h3 class="profile-username text-center"><?php echo ucwords($get->nama) ?></h3>
				<p class="text-muted text-center"></p>
				    <table class="table" style="font-family: arial;">
						<tbody>
							<tr>
								<th class="small text-right">NIP :</th>
								<td class="small"><?php echo $get->nip ?></td>
							</tr>
							<tr>
								<th width="160" class="small text-right">NRP :</th>
								<td class="small"><?php echo $get->nrp ?></td>
							</tr>
							<tr>
								<th class="small text-right">Tempat, Tanggal Lahir :</th>
								<td class="small"><?php echo ucwords($get->tempat_lahir).','. date_id($get->tgl_lahir) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Jenis Kelamin :</th>
								<td class="small"><?php echo ucwords($get->jns_kelamin) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Alamat :</th>
								<td class="small"><?php echo ucwords($get->alamat) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Agama :</th>
								<td class="small"><?php echo ucwords($get->agama) ?></td>
							</tr>
							<tr>
								<th class="small text-right">Pendidikan Terakhir :</th>
								<td class="small"><?php echo ucwords($get->pendidikan_terakhir) ?></td>
							</tr>
						</tbody>
					</table>
			</div>
		</div>
    </div>

<div class="row">
	<div class="col-md-8 pull-right" style="margin-left: -10px;">
		<div class="box box-primary">
			<div class="box-header">
				<div class="col-md-8 pull-right">
					<div class="col-md-8 col-md-offset-6 col-xs-12">
						<a href="<?php echo base_url('kepangkatan/create_pangkat/'.$get->ID) ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
						<a href="<?php echo site_url("kepangkatan/print_out_detail/{$get->ID}") ?>" class="btn btn-success btn-print_detail" id="reset-form"><i class="fa 
							fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped">
					<thead class="bg-green">

						<tr>
							<th rowspan="2" class="text-center" style="vertical-align: middle;" >No.</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">PANGKAT</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">GOLONGAN</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">NOMOR SK</th>
							
							<th colspan="2" class="text-center">TMT</th>
							<th></th>
							<th></th>
													
						</tr>
						<tr>
							<th class="text-center">TMT</th>
							<th class="text-center">YAD</th>
							<th class="text-center">PEMBERITAUAN</th>
							<th></th>
							
						</tr>

					</thead>

					<tbody>

					 <?php foreach($this->mkepangkatan->detail_kepangkatan($get->nip) as $row) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td class="text-center"><?php echo $this->mkepangkatan->pangkat($row->id_pangkat)->nama_pangkat ?></td>
							<td class="text-center"><?php echo $this->mkepangkatan->pangkat($row->id_pangkat)->golongan ?></td>
							<td class="text-center"><?php echo $row->no_sk ?></td>
							<td class="text-center"><?php echo date_id($row->tmt) ?></td>
							<td class="text-center"><?php echo date_id($row->batas_akhir) ?></td>

							<?php if ($row->batas_akhir > date('Y-m-d')): ?>
								<!-- warna hijau -->
								<?php if ($this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 150 ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-success" >
										<?php echo $this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) ?> Hari</span>
									</td>
								<?php endif ?>
								<!-- warna kuning -->
								<?php if ($this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) < 150 AND $this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 60  ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-warning" >
										<?php echo $this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) ?> Hari</span>
									</td>
								<?php endif ?>
								<!-- jika kondisi merah peingatan -->
								<?php if ($this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) < 60 AND $this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 30 ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-danger" >
										SIAPKAN BERKAS</span>
									</td>
								<?php endif ?>
								<!-- jika kondisi telah lewat -->
								<?php if ($this->mkepangkatan->hitungHari(date('Y-m-d'), $row->batas_akhir) < 30 ): ?>
									<td class="text-center">
										<span id="textkedip" data-toggle="tooltip" data-placement="top" class="label label-danger" >
										Waktu Telah Lewat</span>
									</td>
								<?php endif ?>
								<?php else: ?>
									<td class="text-center">
										<span id="textkedip" data-toggle="tooltip" data-placement="top" class="label label-danger" >
										Waktu Telah Lewat</span>
									</td>
							<?php endif ?>
							<td class="text-left">
								<a href="<?php echo base_url('kepangkatan/update/'.$row->ID) ?>" class="btn btn-xs btn-primary" style="margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Sunting">
									<i class="fa fa-pencil"></i>
								</a>
						
								<a href="javascript:void(0)" id="delete-kepangkatan" data-id="<?php echo $row->ID ?>" data-back="<?php echo $param ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>						
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade in modal-danger" id="modal-delete" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Perhatian!</h4>
                <span>Hapus data ini dari sistem?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a id="delete-yes" class="btn btn-outline"> YA </a>
            </div>
        </div>
    </div>
</div> 
<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */