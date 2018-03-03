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
						<a href="<?php echo base_url('p16') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
					<div class="col-md-3 pull-right">
	
						<a href="<?php echo site_url("p16/print_out?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-success btn-print" id="reset-form"><i class="fa fa-print"></i> Cetak</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped table-condensed">
					<thead class="bg-green">
						<tr>
							<th class="text-center">NO</th>
							<th class="text-center">NOMOR PRINT</th>
							<th class="text-center">DASAR</th>
							<th class="text-center">UNTUK</th>
							<th class="text-center">TANGGAL DIBUAT</th>
							<th width="100"></th>
						</tr>
					</thead>

					<tbody class="hoverTable">
						<?php foreach($p16 as $row) : ?>
						<tr style="vertical-align: top">
							<td class="text-center"><?php echo ++$this->page ?>.</td>
							<td><?php echo highlight_phrase($row->nomor_print, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo $row->dasar ?>  </td>
							<td><?php echo highlight_phrase($row->untuk, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
							<td><?php echo highlight_phrase(date_id($row->tanggal_masuk), $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
													
							<td class="text-left">

								<a href="<?php echo base_url('p16/update/'.$row->ID_primary_p16) ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Sunting P-16 ini." style="margin-right: 10px">
									<i class="fa fa-pencil"></i>
								</a>
								
								<a href="javascript:void(0)" id="delete-p16" data-toggle="tooltip" data-placement="top" title="Hapus P-16 ini." data-id="<?php echo $row->ID_primary_p16 ?>" class="btn btn-xs btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="6"><small class="pull-right">Ditampilkan <?php echo count($p16) . " dari " . $num_p16 . " data"; ?></small></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer no-padding">
				<pre>
					<?php print_r($p16); ?>	
				</pre>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>


<div class="modal fade in modal-danger" id="modal-delete-p16" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
