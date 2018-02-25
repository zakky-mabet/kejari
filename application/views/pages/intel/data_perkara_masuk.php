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
						<a href="<?php echo base_url('perkara') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('perkara') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
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
							<th class="text-center">TANGGAL MASUK</th>
							<th class="text-center">ASAL</th>
							<th class="text-center">INSTRUKSI</th>
							<th class="text-center">STATUS TELAAH</th>
							<th width="100"></th>
						</tr>
					</thead>

					<tbody class="hoverTable">
						<?php foreach($perkara as $row) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td><?php echo highlight_phrase($row->nomor, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase(date_id($row->tanggal_masuk), $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
							<td><?php echo highlight_phrase($row->asal, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?> </td>
							<td><?php if (!$row->instruksi) { echo '<span class="text-red">Belum di Instruksikan<span>!'; } else { echo $row->instruksi; }   ?></td>
							<td><?php if (!$row->id_terusan_disposisi) { echo '<span class="text-red">Belum di Telaah<span>!'; } else { echo 'Telah di Telaah'; }   ?></td>
							<td class="text-left">
								
								<?php if ($this->mperkara->security($row->ID_primary_terusan_disposisi, 'cek_id_terusan_disposisi_telaah') == 1 AND $row->petunjuk == NULL ): ?>
									<a href="<?php echo base_url('perkara/update_telaah/'.$row->ID_primary_telaah) ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Sunting Telaahan ini" style="margin-right: 10px">
									<i class="fa fa-pencil"></i> </a>
								<?php elseif($row->petunjuk == NULL): ?>
								<a href="<?php echo base_url('perkara/create_telaah/'.$row->ID_primary_terusan_disposisi) ?>" data-toggle="tooltip" data-placement="top" title="Buat Telaahan Intelijen" class="btn btn-xs btn-success" style="margin-right: 10px">
								<i class="fa fa-send"></i></a>
								<?php else: ?>
									<a  data-toggle="tooltip" data-placement="top" title="Tidak Ada Lagi Opsi, Dokumen Telaahan telah di beri petunjuk" class="btn btn-xs btn-warning" style="margin-right: 10px"><i class="fa fa-info-circle"></i></a>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="7"><small class="pull-right">Ditampilkan <?php echo count($perkara) . " dari " . $num_perkara . " data"; ?></small></td>
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
