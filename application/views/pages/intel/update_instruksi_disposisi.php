<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
			<?php
			echo form_open(current_url(), array('class' => ''));
			?>
			<div class="box-body" style="margin-top: 10px;">


				<div class="form-group">
                	<label>Instruksi : <strong class="text-red">*</strong></label>
                	<textarea name="instruksi" rows="8" placeholder="Tulis Instruksi di sini." autofocus class="textarea form-control"><?php echo $get->instruksi ?></textarea>
					<p class="help-block"><?php echo form_error('instruksi', '<small class="text-red">', '</small>'); ?></p>
              </div>

              <div class="form-group">
                	<label>Disposisi/ Diteruskan  : <strong class="text-red">*</strong> </label>
                		<p><input type="checkbox" onfocus="" name="group_id" value="4"  class="minimal" checked >  SEKSI INTELIJEN </p>
<!--                 		<p><input type="checkbox" class="minimal" disabled="disabled" >  SEKSI PIDSUS </p>
                		<input type="checkbox" class="minimal" disabled="disabled" >  SEKSI PIDUM <p></p>
                		<input type="checkbox" class="minimal" disabled="disabled" >  SEKSI DATUN	 -->

					<p class="help-block"><?php echo form_error('group_id', '<small class="text-red">', '</small>'); ?></p>
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