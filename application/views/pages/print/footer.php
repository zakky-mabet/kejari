		<small style="font-size: 9px;" class="prit-at">
			Dicetak oleh <strong><?php echo $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name ?></strong> pada <?php echo date_id('Y-m-d', TRUE).date(' H:i A') ?>
		</small>
	</div>
	<div class="pagebreak"></div>
   	</body>
</html>