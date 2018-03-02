

    		</section>
  		</div>
  		<footer class="main-footer">
	    	<div class="pull-right hidden-xs">
           <img src="<?php echo base_url("public/images/trademark.png") ?>" alt="Tradmark" height="40">
	    	</div>
    		<strong>Versi 1.0</strong> <br>&copy; <?php echo (date('Y')!=2018) ? date('2018 - Y') : date("Y");  ?> - KEJAKSAAN NEGERI Kab. Bangka Barat, Kep. Bangka Belitung.
  		</footer>
	</div>

        <div class="modal fade in modal-danger" id="logoff" tabindex="-1" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Keluar!</h4>
                <span>Yakin anda akan Keluar dari sistem?</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="<?php echo base_url("auth/logout?from_url=".current_url()) ?>" type="button" class="btn btn-outline"> Iya </a>
              </div>
            </div>
          </div>
        </div> 

        
</body>
</html>