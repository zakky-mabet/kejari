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
					<th class="text-center" style="vertical-align: middle;">NAMA</th>
					<th class="text-center" style="vertical-align: middle;">TANGGAL MULAI TERDAFAR</th>
					<th class="text-center" style="vertical-align: middle;">BATAS AKHIR</th>
					<th class="text-center" style="vertical-align: middle;">KETERANGAN</th>
				</tr>
			</thead>
			<tbody class="hoverTable">
				<?php if (!$gaji_berkala): ?>
					<tr>
						<td colspan="10" class="text-center">Belum ada Data</td>
					</tr>
				<?php else: ?>
			<?php foreach($gaji_berkala as $row ) : ?>
				<tr style="vertical-align: top">
					<td class="text-center"><?php echo ++$this->page ?>.</td>
					<td><?php echo $row->nip ?></td>
					<td><?php echo $row->nama_pegawai ?></td>
					<td class="text-center"><?php echo date_id($row->tmt) ?></td>
					<td class="text-center"><?php echo date_id($row->batas_akhir) ?></td>
					<td><?php echo $row->keterangan ?></td>
				</tr>
								
					<?php endforeach; ?>
				<?php endif ?>
				</tbody>
			</table>
		</div>
		<?php
		$this->load->view('pages/print/footer');