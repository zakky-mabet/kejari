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
					<th class="text-center" style="vertical-align: middle;">NAMA PEGAWAI</th>
					<th class="text-center" style="vertical-align: middle;">NAMA DIKLAT</th>
					<th class="text-center" style="vertical-align: middle;">TANGGAL MULAI</th>
					<th class="text-center" style="vertical-align: middle;">TANGGAL SELESAI</th>
					<th class="text-center" style="vertical-align: middle;">TINGKAT</th>
					<th class="text-center" style="vertical-align: middle;">KETERANGAN</th>
				</tr>
			</thead>
			<tbody class="hoverTable">
				<?php if (!$diklat_cetak): ?>
					<tr>
						<td colspan="10" class="text-center">Belum ada Data</td>
					</tr>
				<?php else: ?>
			<?php foreach($diklat_cetak as $row ) : ?>
				<tr style="vertical-align: top">
					<td class="text-center"><?php echo ++$this->page ?>.</td>
					<td class="text-center"><?php echo $row->nip ?></td>
					<td class="text-center"><?php echo $row->nama_pegawai ?></td>
					<td class="text-center"><?php echo $row->nama ?></td>
					<td class="text-center"><?php echo date_id($row->tgl_mulai) ?></td>
					<td class="text-center"><?php echo date_id($row->tgl_selesai) ?></td>
					<td class="text-center"><?php echo $row->tingkat?></td>
					<td class="text-center"><?php echo $row->keterangan?></td>

				</tr>
								
					<?php endforeach; ?>
				<?php endif ?>
				</tbody>
			</table>
		</div>
		<?php
		$this->load->view('pages/print/footer');