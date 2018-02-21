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
			<br>
			<br>
			<table>
				<tbody>
					<tr>
						<th class="small text-right">NAMA :</th>
						<td class="small"><?php echo $get->nama ?></td>
					</tr>
					<tr>
						<th class="small text-right">NIP :</th>
						<td class="small"><?php echo $get->nip ?></td>
					</tr>
					<tr>
						<th width="160" class="small text-right">NRP :</th>
						<td class="small"><?php echo $get->nrp ?></td>
					</tr>
					<tr>
						<th class="small text-right">Tempat, Tanggal Lahir :</th>
						<td class="small"><?php echo ucwords($get->tempat_lahir).','. date_id($get->tgl_lahir) ?></td>
					</tr>
					<tr>
						<th class="small text-right">Jenis Kelamin :</th>
						<td class="small"><?php echo ucwords($get->jns_kelamin) ?></td>
					</tr>
					<tr>
						<th class="small text-right">Alamat :</th>
						<td class="small"><?php echo ucwords($get->alamat) ?></td>
					</tr>
					<tr>
						<th class="small text-right">Agama :</th>
						<td class="small"><?php echo ucwords($get->agama) ?></td>
					</tr>
					<tr>
						<th class="small text-right">Pendidikan Terakhir :</th>
						<td class="small"><?php echo ucwords($get->pendidikan_terakhir) ?></td>
					</tr>
				</tbody>
			</table>

			<table class="table-bordered" style="width: 100%; font-size: 10px;">
			<thead class="bg-green">
				<tr >
					<th rowspan="2" style="vertical-align: middle;">No.</th>

					<th class="text-center" style="vertical-align: middle;">PANGKAT</th>
					<th class="text-center" style="vertical-align: middle;">GOLONGAN</th>
					<th class="text-center" style="vertical-align: middle;">NOMOR SK</th>
					<th class="text-center" style="vertical-align: middle;">TMT</th>
					<th class="text-center" style="vertical-align: middle;">BATAS AKHIR</th>
					
				</tr>
			</thead>
			<tbody class="hoverTable">
			<?php foreach($this->mkepangkatan->detail_kepangkatan($get->nip) as $row) : ?>
				<tr style="vertical-align: top">
					<td class="text-center"><?php echo ++$this->page ?>.</td>
					<td><?php echo $this->mkepangkatan->pangkat($row->id_pangkat)->nama_pangkat ?></td>
					<td><?php echo $this->mkepangkatan->pangkat($row->id_pangkat)->golongan ?></td>
					<td class="text-left"><?php echo $row->no_sk ?></td>
					<td class="text-center"><?php echo date_id($row->tmt) ?></td>
					<td class="text-center"><?php echo date_id($row->batas_akhir) ?></td>
				</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php
		$this->load->view('pages/print/footer');