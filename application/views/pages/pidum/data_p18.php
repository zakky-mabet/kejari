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
					<div class="col-md-4">
						<input type="text" class="form-control" name="query" placeholder="Pencarian...." value="<?php echo $this->input->get('query') ?>">
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-success" id="search"><i class="fa fa-search"></i> Cari Data</button>
						<a href="<?php echo base_url('p18') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
	
						<a href="<?php echo site_url("p18/print_out?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-success btn-print" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped table-condensed">
					<thead class="bg-green">
						<tr>
							<th class="text-center">NO</th>
							<th class="text-center">NOMOR</th>
							<th class="text-center">SIFAT</th>
							<th class="text-center">PERIHAL</th>
							<th class="text-center">KEPADA</th>
							<th class="text-center">TANGGAL DIBUAT</th>
							<th width="100"></th>
						</tr>
					</thead>

					<tbody class="hoverTable">
					
						<?php foreach($p18 as $row) : ?>

						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td><?php echo highlight_phrase($row->nomor_p18, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase($row->sifat_p18, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase($row->perihal_p18, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase($row->dikirim_kepada_p18, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase(date_id($row->tanggal_create_p18), $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
													
							<td class="text-left">

								<?php if ($this->mp18->cek_id_p18_on_p19($row->ID_primary_p18) == 0): ?> 
								<a href="<?php echo base_url('p19/create/'.$row->ID_primary_p18) ?>" data-toggle="tooltip" data-placement="top" title="Buat Surat Pengembalian Berkas Perkara" class="btn btn-xs btn-success" style="margin-right: 10px">
									<i class="fa fa-send"></i> </a>
								<?php else: ?>

								<?php endif ?>

								<a href="<?php echo base_url('p18/update/'.$row->ID_primary_p18) ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Sunting P-16 ini." style="margin-right: 10px">
									<i class="fa fa-pencil"></i>
								</a>
								
								<a href="javascript:void(0)" id="delete-p18" data-toggle="tooltip" data-placement="top" title="Hapus P-18 ini." data-id="<?php echo $row->ID_primary_p18 ?>" class="btn btn-xs btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="7"><small class="pull-right">Ditampilkan <?php echo count($p18) . " dari " . $num_p18 . " data"; ?></small></td>
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

<div class="modal fade in modal-danger" id="modal-delete-p18" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
