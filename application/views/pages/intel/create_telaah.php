<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-primary">
			<?php
			echo form_open(current_url(), array('class' => ''));
			?>
			<div class="box-body" style="margin-top: 10px;">
				
				<div class="form-group">
                	<label>Nomor : <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control" autofocus name="no_telaah" value="<?php echo set_value('no_telaah') ?>" >
                        <p class="help-block"><?php echo form_error('no_telaah', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

              	<div class="form-group">
                	<label>Pokok Permasalahan : <strong class="text-red">*</strong></label>
                	<input type="text"  class="form-control"  name="pokok_permasalahan" value="<?php echo set_value('pokok_permasalahan') ?>" >
                        <p class="help-block"><?php echo form_error('pokok_permasalahan', '<small class="text-red">', '</small>'); ?></p>            
              	</div>

				<div class="form-group">
                	<label>Uraian Permasalahan : <strong class="text-red">*</strong></label>
                	<textarea name="uraian_permasalahan" rows="8"  placeholder="Tulis Uraian Permasalahan di sini." class="textarea form-control"><?php echo set_value('uraian_permasalahan') ?></textarea>
					<p class="help-block"><?php echo form_error('uraian_permasalahan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Telaahan : <strong class="text-red">*</strong></label>
                	<textarea name="telaahan" rows="5" class=" form-control"><?php echo set_value('telaahan') ?></textarea>
					<p class="help-block"><?php echo form_error('telaahan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Kesimpulan : <strong class="text-red">*</strong></label>
                	<textarea name="kesimpulan" rows="4"   class=" form-control"><?php echo set_value('kesimpulan') ?></textarea>
					<p class="help-block"><?php echo form_error('kesimpulan', '<small class="text-red">', '</small>'); ?></p>
              	</div>

              	<div class="form-group">
                	<label>Saran Tindak : <strong class="text-red">*</strong></label>
                	<textarea name="saran_tindak" rows="4" class=" form-control"><?php echo set_value('saran_tindak') ?></textarea>
					<p class="help-block"><?php echo form_error('saran_tindak', '<small class="text-red">', '</small>'); ?></p>
              	</div>

       				
				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('perkara') ?>" class="btn btn-app pull-right">
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
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>