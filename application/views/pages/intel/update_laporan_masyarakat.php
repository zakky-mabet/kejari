<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<dov class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open(current_url(), array('class' => 'form-horizontal'));
echo form_hidden('user_id', $user->id );
echo form_hidden('ID', $get->ID );
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
			
				<div class="form-group">
                    <label for="nomor" class="control-label col-md-3 col-xs-12">Nomor : <strong class="text-red">*</strong></label>
                    <div class="col-md-8">
                    <input type="text"  class="form-control" name="nomor" value="<?php echo $get->nomor ?>" placeholder="Nomor">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="asal" class="control-label col-md-3 col-xs-12">Asal :<strong class="text-red">*</strong></label>
                    <div class="col-md-8">
                    <input type="text"  class="form-control" name="asal" value="<?php echo $get->asal ?>">
                        <p class="help-block"><?php echo form_error('asal', '<small class="text-red">', '</small>'); ?></p>            
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="control-label col-md-3 col-xs-12">Prihal : <strong class="text-red">*</strong></label>
                    <div class="col-md-8">
                   	<textarea name="deskripsi" rows="6" class="form-control"><?php echo $get->deskripsi ?></textarea>
                        <p class="help-block"><?php echo form_error('deskripsi', '<small class="text-red">', '</small>'); ?></p>            
                    </div>
                </div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('laporan_masyarakat/data_laporan') ?>" class="btn btn-app pull-right">
						<i class="ion ion-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-save"></i> Simpan
					</button>
				</div>
			</div>
			<div class="box-footer with-border">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional</small>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</dov>
</div>