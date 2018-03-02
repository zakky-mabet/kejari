<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-primary">
<?php  
echo form_open(current_url(), array('class' => ''));
?>
			<div class="box-body" style="margin-top: 10px;">

				<div class="form-group">
                    <label for="nomor" class="control-label">Nomor : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control" autofocus name="nomor" value="<?php echo set_value('nomor') ?>">
                        <p class="help-block"><?php echo form_error('nomor', '<small class="text-red">', '</small>'); ?></p>            
                </div>
               <div class="form-group">
                    <label for="asal" class="control-label">Asal : <strong class="text-red">*</strong></label>
                    <input type="text"  class="form-control"  name="asal" value="<?php echo set_value('asal') ?>">
                        <p class="help-block"><?php echo form_error('asal', '<small class="text-red">', '</small>'); ?></p>            
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="control-label">Deskripsi : <strong class="text-red">*</strong></label>
                   	<textarea name="deskripsi" rows="8" class="form-control "><?php echo set_value('deskripsi') ?></textarea>
                        <p class="help-block"><?php echo form_error('deskripsi', '<small class="text-red">', '</small>'); ?></p>            
                </div>

              
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					
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
echo form_close();
?>
		</div>
	</div>
</div>