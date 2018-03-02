<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
<div class="col-md-8 col-md-offset-2 col-xs-12">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
  <strong><?php echo $this->session->flashdata('alert'); ?></strong>
</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<?php echo form_open(current_url(), array('method' => 'GET')); echo form_hidden('per_page', $per_page); ?>
			<div class="box-header">
				<div class="col-md-12">
	
					<div class="col-md-3">
						<input type="text" class="form-control" name="query" placeholder="Pencarian...." value="<?php echo $this->input->get('query') ?>">
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-success" id="search"><i class="fa fa-search"></i> Cari Data</button>
						<a href="<?php echo current_url('') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('laporan_informasi/create') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
						<a href="<?php echo site_url("laporan_informasi/print_out?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-success btn-print" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped table-condensed">
					<thead class="bg-green">
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NOMOR</th>
							<th class="text-center">INFORMASI YANG DIPEROLEH</th>
							<th class="text-center">SUMBER INFORMASI</th>
							<th class="text-center">KATEGORI</th>
							<th class="text-center">TANGGAL DIBUAT</th>
							<th width="100"></th>
						</tr>
					</thead>

					<tbody class="hoverTable">
						<?php foreach($harian as $row) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td><?php echo highlight_phrase($row->nomor, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase($row->informasi_diperoleh, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase($row->sumber_informasi, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?> </td>
							<td><?php echo highlight_phrase($row->kategori, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?> </td>
							<td><?php echo highlight_phrase(date_id($row->tanggal_create), $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
							<td class="text-left">
								
									<a href="<?php echo base_url('laporan_informasi/update/'.$row->ID) ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Sunting Laporan Informasi ini." style="margin-right: 10px">
									<i class="fa fa-pencil"></i>
								</a>
							
								
								<a href="javascript:void(0)" id="delete-laporan-informasi" data-toggle="tooltip" data-placement="top" title="Hapus Laporan ini." data-id="<?php echo $row->ID ?>" data-disposisi="<?php echo $row->ID ?>" class="btn btn-xs btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="7"><small class="pull-right">Ditampilkan <?php echo count($harian) . " dari " . $num_harian . " data"; ?></small></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer no-padding">

			</div>
		</div>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>


<div class="modal fade in modal-danger" id="modal-delete-laporan-informasi" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Perhatian!</h4>
                <span>Hapus data ini dari sistem?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a id="delete-yes" class="btn btn-outline"> Iya </a>
            </div>
        </div>
    </div>
</div>

<?php
