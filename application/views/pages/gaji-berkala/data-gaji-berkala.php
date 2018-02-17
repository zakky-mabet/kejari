<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.hoverTable{
			width:100%; 
			border-collapse:collapse; 
			}
.hoverTable td
			{ 
			padding:7px; border:#4e95f4 1px solid;
			}
.hoverTable tr:hover
			{
 			background-color: #D8E9A7;
			}

</style> 
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
						<a href="<?php echo base_url() ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('gaji_berkala/create') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
						<a href="<?php echo base_url() ?>" class="btn btn-success" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
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
							<th  class="text-center">Nama</th>
							<th  class="text-center">Tanggal Mulai Terdaftar</th>
							<th  class="text-center">Batas Akhir</th>
							<th  class="text-center">Nomor SK</th>
							<th rowspan="2" class="text-center"></th>
						</tr>
					</thead>
					<tbody class="hoverTable">
						<?php foreach($gaji_berkala as $row ) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td class="text-center"><?php echo $row->nip ?></td>
							<td class="text-center"><?php echo $row->nama_pegawai ?></td>
							<td class="text-center"><?php echo date_id($row->tmt) ?></td>
							<td class="text-center"><?php echo date_id($row->batas_akhir) ?></td>
							<td class="text-center"><?php echo $row->no_sk ?></td>
							<td class="text-center">
								<a href="<?php echo base_url('gaji_berkala/update/'.$row->ID)?>" class="btn btn-xs btn-primary" style="margin-right: 10px">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="javascript:void(0)" id="delete-gaji" data-id="<?php echo  $row->ID ?>" class="btn btn-xs btn-danger">
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
                <a id="delete-yes" class="btn btn-outline"> Ya </a>
            </div>
        </div>
    </div>
</div> 
<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */