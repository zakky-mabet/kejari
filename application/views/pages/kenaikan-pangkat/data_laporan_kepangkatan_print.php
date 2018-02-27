	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* Header Print (KOP)
	*
	* @author Teitra Mega office@teitraega.co.id
	**/
	$this->load->view('pages/print/header');
	?>
	<div class="content " style="margin-bottom: 7px;">
		<h5 class="upper text-center"><?php echo $title; ?></h5>
		<table class="table-bordered" style="width: 100%; font-size: 10px;">
			
			<thead class="bg-green">
				<tr >
					<th rowspan="2" style="vertical-align: middle;">No.</th>
					<th class="text-center" style="vertical-align: middle;">NIP</th>
					<th class="text-center" style="vertical-align: middle;">NRP</th>
					<th class="text-center" style="vertical-align: middle;">PANGKAT</th>
					<th class="text-center" style="vertical-align: middle;">JABATAN</th>
					<th class="text-center" style="vertical-align: middle;">NAMA LENGKAP</th>
					<th class="text-center" style="vertical-align: middle;">TEMPAT, TANGGAL LAHIR</th>
					<th class="text-center" style="vertical-align: middle;">AGAMA</th>
					<th class="text-center" style="vertical-align: middle;">JENIS KELAMIN</th>
					<th  style="vertical-align: middle;">PENDIDIKAN TERAKHIR</th>
					
				</tr>
			</thead>
			<tbody class="hoverTable">
				
			
				<tr style="vertical-align: top">
					<td class="text-center"><?php echo ++$this->page ?>.</td>
					
				</tr>
					
				
				</tbody>
			</table>
		</div>
		<?php
		$this->load->view('pages/print/footer');