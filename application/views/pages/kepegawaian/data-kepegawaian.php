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
						<a href="<?php echo base_url('kepegawaian') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('kepegawaian/create') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
						<a href="<?php echo site_url("kepegawaian/print_out?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-success btn-print" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped" >
					<thead class="bg-green">
						<tr >
							<th rowspan="2" style="vertical-align: middle;">No.</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">NIP</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">NRP</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">NAMA LENGKAP</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">PANGKAT</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">JABATAN</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">TEMPAT, TANGGAL LAHIR</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">AGAMA</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">JENIS KELAMIN</th>
							<th  style="vertical-align: middle;">PDK. TERAKHIR</th>
							
							<th rowspan="2" class="text-center"></th>
						</tr>

					</thead>
					<tbody class="hoverTable">
						<?php foreach($kepegawaian as $row) : ?>
						<tr style="vertical-align: top">
							<td><?php echo ++$this->page ?>.</td>
							<td><?php echo $row->nip ?></td>
							<td><?php echo $row->nrp ?></td>
							<td><?php echo $row->nama ?></td>
							<td>
								<span data-toggle="tooltip" data-placement="top" title="Lihat Detail Ke Pangkat">
								<a href="<?php echo base_url('kepangkatan/detail_kepangkatan/'.$row->ID) ?>"><?php echo $row->pangkat ?></span>
							</td>
							<td><?php echo $row->jabatan ?></td>
							<td><?php echo $row->tempat_lahir ?>, <?php echo date_id($row->tgl_lahir) ?></td>
							<td><?php echo strtoupper($row->agama) ?></td>
							<td><?php echo strtoupper($row->jns_kelamin) ?></td>
							<td class="text-center"><?php echo $row->pendidikan_terakhir ?></td>
							
							
							<td>
								<a href="<?php echo base_url('kepegawaian/update/'.$row->ID) ?>" class="btn btn-xs btn-primary" style="margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Sunting">

									<i class="fa fa-pencil"></i>
								</a>
								<a href="javascript:void(0)" id="delete-pegawai" data-id="<?php echo $row->ID ?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
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