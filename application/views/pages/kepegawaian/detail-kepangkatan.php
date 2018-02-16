<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-4">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="text-center pull-left image">
	              <img width="60%" src="" class="img-circle" alt="User Image">
	        	</div>

        		<br>
        		<br>
				<h3 class="profile-username text-center"></h3>
				<p class="text-muted text-center"></p>
				    <table class="table" style="font-family: arial;">
					
					</table>
			</div>
		</div>

    </div>

<div class="row">
	<div class="col-md-8 pull-right" style="margin-left: -10px;">
		<div class="box box-primary">
			<div class="box-header">
				<div class="col-md-8 pull-right">
					<div class="col-md-3 pull-right">
						<a href="<?php echo base_url('kepangkatan/create') ?>" class="btn btn-success" id="reset-form"><i class="fa fa-plus"></i> Tambahkan</a>
					</div>
				</div>
			</div>
			<div class="box-body no-padding">
				<table class="table table-bordered table-stripped">
					<thead class="bg-green">
						<tr>
							<th rowspan="2" class="text-center" >No.</th>
							<th rowspan="2" class="text-center">Pangkat</th>
							<th rowspan="2" class="text-center">Golongan</th>
							<th rowspan="2" class="text-center">Nomor SK</th>
							<th colspan="2" class="text-center">TMT</th>
													
						</tr>
						<tr>
							<th class="text-center">TMT</th>
							<th class="text-center">YAD</th>
						</tr>
					</thead>

					<tbody>
						<tr style="vertical-align: top">
							<td>no</td>
							<td>pagk</td>
							<td>gol</td>
							<td>no sk</td>
							<td>yad</td>
							<td>tmt</td>
				
						
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php
/* End of file main-anggota.php */
/* Location: ./application/views/pages/anggota/main-anggota.php */