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
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">NOMOR</th>
					<th class="text-center">TANGGAL MASUK</th>
					<th class="text-center">ASAL</th>
					<th class="text-center">INSTRUKSI</th>
				</tr>
			</thead>
			<tbody class="hoverTable">
				<?php foreach($data_laporan as $row) : ?>
				<tr style="vertical-align: top">
					<td class="text-center"><?php echo ++$this->page ?>.</td>
					<td><?php echo highlight_phrase($row->nomor, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?>  </td>
					<td><?php echo highlight_phrase(date_id($row->tanggal_masuk), $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?></td>
					<td><?php echo highlight_phrase($row->asal, $this->input->get('query'),'<span style="color:red; font-weight: bold;">', '</span>'); ?> </td>
					<td><?php if (!$row->instruksi) { echo '<span class="text-red">Belum di Instruksikan<span>!'; } else { echo $row->instruksi; }   ?></td>
				</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
		<?php
		$this->load->view('pages/print/footer');