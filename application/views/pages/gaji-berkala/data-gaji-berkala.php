<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<div class="row">
<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box box-primary">
			<?php echo form_open(current_url(), array('method' => 'GET')); ?>
			<div class="box-header">
				<div class="col-md-12">
					<div class="col-md-4">
						<input type="text" class="form-control" name="query" placeholder="Pencarian...." value="<?php echo $this->input->get('query') ?>">
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-success" id="search"><i class="fa fa-search"></i> Cari Data</button>
						<a href="<?php echo base_url('gaji_berkala') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('gaji_berkala/create') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
						<a href="<?php echo site_url("gaji_berkala/print_out?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-success btn-print" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped">
					<thead class="bg-green">
						<tr>
							<th rowspan="2">No.</th>
							<th  class="text-center">NIP</th>
							<th  class="text-center">NAMA</th>
							<th  class="text-center">TANGGAL MULAI TERDAFTAR</th>
							<th  class="text-center">BATAS AKHIR</th>
							<th  class="text-center">NOMOR SK</th>
							<th class="text-center">KETERANGAN</th>
							<th  width="100px" class="text-center">LAMPIRAN</th>
							<th class="text-center">PEMBERITAHUAN</th>
							<th width="8%" class="text-center"></th>

						</tr>
					</thead>
					<tbody class="hoverTable">
						<?php foreach($gaji_berkala as $row ) : ?>
						<tr>
							<td class="text-center" style="vertical-align: middle;"><?php echo ++$this->page ?>.</td>
							<td class="text-center" style="vertical-align: middle;"><?php echo $row->nip ?></td>
							<td style="vertical-align: middle;"><?php echo $row->nama_pegawai ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php echo date_id($row->tmt) ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php echo date_id($row->batas_akhir) ?></td>
							<td class="text-left" style="vertical-align: middle;"><?php echo $row->no_sk ?></td>
							<td style="vertical-align: middle;"><?php echo $row->keterangan ?></td>							
							<td>
							<?php if($row->lampiran_sk != FALSE) : ?>						
							<button class="btn" id="lihat-gambar" data-src="<?php echo base_url('public/images/gaji-berkala/'.$row->lampiran_sk) ?>">
							 <img width="50%" src="<?php echo base_url('public/images/gaji-berkala/'.$row->lampiran_sk) ?>" class="img-rounded">
							</button>
							<?php else : ?>
							<span class="label label-warning">Lampiran SK Kosong</span>
							<?php endif; ?>

							</td>
							<?php if ($row->batas_akhir >= date('Y-m-d')): ?>
								<!-- warna hijau -->
								<?php if ($this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 150 ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-success" >
										<?php echo $this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) ?> Hari</span>
									</td>
								<?php endif ?>
								<!-- warna kuning -->
								<?php if ($this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) < 150 AND $this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 60  ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-warning" >
										<?php echo $this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) ?> Hari</span>
									</td>
								<?php endif ?>
								<!-- jika kondisi merah peingatan -->
								<?php if ($this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) < 60 AND $this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) >= 30 ): ?>
									<td class="text-center">
										<span data-toggle="tooltip" data-placement="top" class="label label-danger" >
										SIAPKAN BERKAS</span>
									</td>
								<?php endif ?>
								<!-- jika kondisi telah lewat -->
								<?php if ($this->mgaji_berkala->hitungHari(date('Y-m-d'), $row->batas_akhir) < 30): ?>
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
							<td style="vertical-align: middle;">
							<!-- <?php //if ($row->batas_akhir >= date('Y-m-d')): ?> -->
							
								<a href="<?php echo base_url('gaji_berkala/update/'.$row->ID)?>" class="btn btn-xs btn-primary" style="margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Sunting">
									<i class="fa fa-pencil"></i>
								</a>
							<!-- <?php //else: ?>
								<a></i>
								</a>
							<?php //endif ?> -->
								<a href="javascript:void(0)" id="delete-gaji" data-id="<?php echo $row->ID ?>" class="btn btn-xs btn-danger" 
									data-toggle="tooltip" data-placement="top" title="Hapus">
									<i class="fa fa-trash-o"></i>
								</a>

							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
			
				</table>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>

<script>
	$('button#lihat-gambar').unbind().click(function(argument) {
		$('div#exampleModalCenter').modal('show');
		$('img#setImage').attr('src', $(this).data('src'))
	})
</script>

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
                <a id="delete-yes" class="btn btn-outline"> Ya </a>
            </div>
        </div>
    </div>
</div>

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