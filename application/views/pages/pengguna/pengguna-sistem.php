<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$user = $this->db->get_where('kepegawaian', array('id'=> $user->id))->row();?> 
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
						<a href="<?php echo base_url('pengguna') ?>" class="btn btn-default" id="reset-form"><i class="fa fa-times"></i> Reset</a>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped">
					<thead class="bg-green">
						<tr>
							<th>No.</th>
							<th class="text-center">NIP</th>
							<th class="text-center">NAMA PENGGUNA</th>
							<th class="text-center">E-MAIL</th>
							<th class="text-center">TELEPON</th>
							<th class="text-center">LEVEL</th>
							
							<th></th>

						</tr>
					</thead>
					<tbody class="hoverTable">
						<?php foreach ($users as $user):?>
							<tr>
								<td><?php echo ++$this->page ?>.</td>
								<td><?php echo $user->nip ?></td>
								<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8').' '. htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8'); ?>
								</td>
								<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td><?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?></td>
								<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
								

								<td class="text-left">
									
								<a href="<?php echo site_url('pengguna/update_user/'.$user->id) ?>" class="btn btn-xs btn-primary" style="margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Sunting">
									<i class="fa fa-pencil"></i>
								</a>
						
								<a href="javascript:void(0)" id="delete-pengguna" data-id="<?php echo $user->id ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
									<i class="fa fa-trash-o"></i>
								</a>
							
							</td>		
							</tr>
						<?php endforeach;?>
					</tbody>
			
				</table>
			</div>
		</div>
		<div class="col-md-12 text-center">
			
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