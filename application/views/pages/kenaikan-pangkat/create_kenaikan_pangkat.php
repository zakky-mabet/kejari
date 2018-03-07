<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$pangkat = $this->db->get('pangkat')->result();

?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12" >
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open_multipart(current_url(), array('class' => 'form-horizontal'));
?>
			<div class="box-body">
				<div class="form-group">
					<label for="pangkat" class="control-label col-md-3 col-xs-12">Pegawai : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="nip" class="form-control select2">
							<option selected="selected" value="">-- Pilih NIP - Nama Pangkat --</option>
							<?php foreach($this->mkenaikan_pangkat->get_all_pangkat() as $key => $value) : ?>
                                <option value="<?php echo $value->nip; ?>"><?php echo $value->nip.' - '. $value->nama; ?></option>
                            <?php endforeach;?>
						</select>
						<p class="help-block"><?php echo form_error('nip', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="pangkat" class="control-label col-md-3 col-xs-12">Pangkat : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="id_pangkat" class="form-control select2">
							<option selected="selected" value="">-- Pilih Nama Pangkat --</option>
							<?php foreach($pangkat as $key => $value) : ?>
                                <option value="<?php echo $value->ID; ?>"><?php echo $value->nama_pangkat; ?></option>
                            <?php endforeach;?>
						</select>
						<p class="help-block"><?php echo form_error('id_pangkat', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="no_sk" class="control-label col-md-3 col-xs-12">TMT : <strong class="text-red">*</strong></label>
					<div class="col-md-6">
						<input type="text" name="date" id="datepicker" class="form-control" value="">
						<p class="help-block"><?php echo form_error('date', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="no_sk" class="control-label col-md-3 col-xs-12">Nomor SK : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="no_sk" class="form-control" value="">
						<p class="help-block"><?php echo form_error('no_sk', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="telepon" class="control-label col-md-3 col-xs-12">Lampiran SK : <strong class="text-blue">*</strong></label>
					<div class="col-md-6">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="alamat" class="control-label col-md-3">Keterangan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<textarea name="keterangan" rows="8" class="form-control"></textarea>
						<p class="help-block"><?php echo form_error('keterangan', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('kepegawaian') ?>" class="btn btn-app pull-right">
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
	</div>
</div>

<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */