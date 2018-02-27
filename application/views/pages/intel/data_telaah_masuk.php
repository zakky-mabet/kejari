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
						<a href="<?php echo base_url('dokumen_telaah') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('dokumen_telaah') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped table-condensed">
					<thead class="bg-green">
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NOMOR TELAAH</th>
							<th class="text-center">POKOK PERMASALAHAN</th>
							<th class="text-center">SARAN TINDAK</th>
							<th class="text-center">PETUNJUK</th>
							<th class="text-center">STATUS PETUNJUK</th>
							<th width="100"></th>
						</tr>
					</thead>

					<tbody class="hoverTable">
						<?php foreach($dokumen_telaah as $row) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td><?php echo highlight_phrase($row->no_telaah, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase(substr($row->pokok_permasalahan,0, 40).'...', $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
							<td><?php echo highlight_phrase(substr($row->saran_tindak,0,40).'...', $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?> </td>
							<td><?php if (!$row->petunjuk) { echo '<span class="text-grey">Belum ada Petunjuk<span>!'; } else { echo substr($row->petunjuk, 0, 50); }   ?></td>
							<td><?php if (!$row->petunjuk) { echo '<span class="text-red">Belum di beri petunjuk<span>!'; } else { echo 'Telah di beri Petunjuk'; }   ?></td>
							<td class="text-left">
								<?php if ($row->status_petunjuk == 'telah'): ?>

									<a href="<?php echo base_url('dokumen_telaah/update_petunjuk/'.$row->ID_primary_telaah) ?>" data-toggle="tooltip" data-placement="top" title="Sunting Petunjuk ini" class="btn btn-xs btn-primary" style="margin-right: 10px">
								<i class="fa fa-pencil"></i></a>
								<?php else: ?>
								
								<a href="<?php echo base_url('dokumen_telaah/create_petunjuk/'.$row->ID_primary_telaah) ?>" data-toggle="tooltip" data-placement="top" title="Beri Petunjuk Atas Dokumen Telaah ini atau tidak dilanjutkan" class="btn btn-xs btn-success" style="margin-right: 10px">
								<i class="fa fa-send"></i></a>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="7"><small class="pull-right">Ditampilkan <?php echo count($dokumen_telaah) . " dari " . $num_dokumen_telaah . " data"; ?></small></td>
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
                <a id="delete-yes" class="btn btn-outline"> Iya </a>
            </div>
        </div>
    </div>
</div>

<?php
