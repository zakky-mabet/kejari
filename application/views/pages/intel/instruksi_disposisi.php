<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
			<?php
			echo form_open(current_url(), array('class' => 'form-horizontal'));
			?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="instruksi" class="control-label col-md-3 col-xs-12">Instruksi : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<textarea name="instruksi" rows="8" class="form-control"><?php echo set_value('instruksi') ?></textarea>
						<p class="help-block"><?php echo form_error('instruksi', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="group_id" class="control-label col-md-3 col-xs-12">Disposisi : <strong class="text-red"></strong> <a href="#" data-toggle="tooltip" data-placement="top" title="Disposisi dipilih secara otomatis"><i class="fa fa-info-circle"></i></a></label>
					<div class="col-md-8">
						<div class="radio radio-inline radio-primary">
							<input name="group_id" type="radio" value="4" checked="checked"> <label for="group_id">SEKSI INTELIJEN</label>
						</div>
						<p class="help-block"><?php echo form_error('group_id', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="box-footer with-border">
					<div class="col-md-4 col-xs-5">
						<a href="<?php echo site_url('laporan_masyarakat') ?>" class="btn btn-app pull-right">
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