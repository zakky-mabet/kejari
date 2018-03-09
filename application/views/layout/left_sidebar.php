
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar sidebar-mini"> 
    <section class="sidebar">
      	<div class="user-panel">
        	<div class="pull-left image">
              <img src="<?php echo base_url('public/images/users/default.png') ?>" class="img-circle" alt="User Image">
        	</div>
        	<div class="pull-left info">
          		<p><?php echo $user->first_name.' '.$user->last_name ?></p>
          		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        	</div>
      	</div>
      	<ul class="sidebar-menu" data-widget="tree">
        	<li class="<?php echo active_link_controller('welcome') ?>">
	          	<a href="<?php echo base_url('welcome') ?>">
	            	<i class="fa fa-dashboard"></i> <span>Dashboard</span>
	          	</a>
        	</li>
          <li class="<?php echo active_link_method('index','laporan_masyarakat') ?>">
              <a href="<?php echo base_url('laporan_masyarakat') ?>">
                <i class="fa fa-pencil"></i> <span>Buat Laporan Perkara</span>
              </a>
          </li>
          <li class="<?php echo active_link_method('data_laporan','laporan_masyarakat') ?>">
              <a href="<?php echo base_url('laporan_masyarakat/data_laporan') ?>">
                <i class="fa fa-file-text"></i> <span>Data Laporan Perkara</span> <?php if ($this->mlaporan_masyarakat->notification_laporan_masyarakat() !=0): ?>
                 <span data-toggle="tooltip" data-placement="top" title="<?php echo $this->mlaporan_masyarakat->notification_laporan_masyarakat() ?> Data Laporan Masyarakat Belum di Instruksikan" class="label label-danger pull-right"><?php echo $this->mlaporan_masyarakat->notification_laporan_masyarakat() ?></span> <?php endif ?>
              </a>
          </li>
          
          <li class="treeview <?php echo active_link_multiple(array('dokumen_telaah')); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>KAJARI</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('index', 'dokumen_telaah') ?>">
                    <a href="<?php echo base_url('dokumen_telaah/index') ?>"><i class="fa fa-angle-double-right"></i> Dokumen Telaah Masuk   <?php if ($this->mdokumen_telaah->get_all(null,null,'notifikasi') !=0 ): ?> <span data-toggle="tooltip" data-placement="top" title="<?php echo $this->mdokumen_telaah->get_all(null,null,'notifikasi') ?> Data Perkara Belum di Telaah" class="label label-danger pull-right"><?php echo $this->mdokumen_telaah->get_all(null, null,'notifikasi') ?></span>  <?php endif ?> </a>
                </li>
                
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('perkara','perintah_op','lapopsin')); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>INTELIJEN</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('index', 'perkara') ?>">
                    <a href="<?php echo base_url('perkara/index') ?>"><i class="fa fa-angle-double-right"></i> Data Perkara Masuk 
                      <?php if ($this->mperkara->notifikasi() !=0 ): ?>
                    <span data-toggle="tooltip" data-placement="top" title="<?php echo $this->mperkara->notifikasi() ?> Data Perkara Belum di Telaah" class="label label-danger pull-right"><?php echo $this->mperkara->notifikasi() ?></span>  <?php endif ?></a>
                </li>
                <li class="<?php echo active_link_method('index', 'perintah_op') ?>">
                    <a href="<?php echo base_url('perintah_op/index') ?>"><i class="fa fa-angle-double-right"></i>Surat Perintah Operasi  <?php if ($this->mperintah_op->notifikasi() !=0 ): ?>
                    <span data-toggle="tooltip" data-placement="top" title="<?php echo $this->mperintah_op->notifikasi() ?> Surat belum di buat" class="label label-danger pull-right"><?php echo $this->mperintah_op->notifikasi() ?></span>  <?php endif ?></a>
                </li>
                  <li class="<?php echo active_link_method('index', 'lapopsin') ?>">
                    <a href="<?php echo base_url('lapopsin/index') ?>"><i class="fa fa-angle-double-right"></i>  Laporan Hasil Operasi <?php if ($this->mlapopsin->notifikasi() !=0 ): ?>
                    <span data-toggle="tooltip" data-placement="top" title="<?php echo $this->mlapopsin->notifikasi() ?> Laporan Belum dibuat" class="label label-danger pull-right"><?php echo $this->mlapopsin->notifikasi() ?></span>  <?php endif ?></a>
                </li>
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('laporan_informasi')); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>Laporan Informasi </span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('create', 'laporan_informasi') ?>">
                    <a href="<?php echo base_url('laporan_informasi/create') ?>"><i class="fa fa-angle-double-right"></i> Buat Laporan Informasi </a>
                </li>
                <li class="<?php echo active_link_method('harian', 'laporan_informasi') ?>">
                    <a href="<?php echo base_url('laporan_informasi/harian') ?>"><i class="fa fa-angle-double-right"></i> Laporan Informasi Harian </a>
                </li>
                 <li class="<?php echo active_link_method('khusus', 'laporan_informasi') ?>">
                    <a href="<?php echo base_url('laporan_informasi/khusus') ?>"><i class="fa fa-angle-double-right"></i> Laporan Informasi Khusus </a>
                </li>
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array()); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>PIDSUS</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Data Laporan Masyarakat</a>
                </li>
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array()); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>DATUN</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Data Laporan Masyarakat</a>
                </li>
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('spdp','p16')); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>PIDUM</span>
                  <span class="pull-right-container"> 
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('create', 'spdp') ?>">
                    <a href="<?php echo base_url('spdp/create') ?>"><i class="fa fa-angle-double-right"></i> Buat SPDP</a>
                </li>
                <li class="<?php echo active_link_method('index', 'spdp') ?>">
                    <a href="<?php echo base_url('spdp/index') ?>"><i class="fa fa-angle-double-right"></i> Data SPDP</a>
                </li>
                 <li class="<?php echo active_link_method('index', 'p16') ?>">
                    <a href="<?php echo base_url('p16/index') ?>"><i class="fa fa-angle-double-right"></i> Data Surat P-16</a>
                </li>
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('kepegawaian','kepangkatan','diklat','gaji_berkala','kenaikan_pangkat')); ?>">
              <a href="#">
                  <i class="fa fa-users"></i> <span>Kepegawaian</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('index','kepegawaian').active_link_method('update','kepegawaian').active_link_method('detail_kepangkatan','kepangkatan').active_link_method('create','kepangkatan').active_link_method('create_pangkat','kepangkatan').active_link_method('update','kepangkatan')?>">

                  <a href="<?php echo base_url('kepegawaian') ?>"><i class="fa fa-angle-double-right"></i> Data Kepegawaian
                  <span data-toggle="tooltip" data-placement="top" title="Laporan Belum dibuat" class="label label-danger pull-right"></span>
                  </a>
                  
                  
                </li>
                <li class="<?php echo active_link_method('create','kepegawaian') ?>">
                    <a href="<?php echo base_url('kepegawaian/create') ?>"><i class="fa fa-angle-double-right"></i> Tambah Pegawai</a>
                </li>
                <li class="<?php echo active_link_method('index','kenaikan_pangkat').active_link_method('create','kenaikan_pangkat') ?>">
                    <a href="<?php echo base_url('kenaikan_pangkat/create') ?>"><i class="fa fa-angle-double-right"></i> Kenaikan Pangkat</a>
                </li>
                <li class="<?php echo active_link_method('index','gaji_berkala').active_link_method('create','gaji_berkala').active_link_method('update','gaji_berkala') ?>">
                    <a href="<?php echo base_url('gaji_berkala') ?>"><i class="fa fa-angle-double-right"></i> Gaji Berkala</a>
                </li>
                <li class="<?php echo active_link_method('index','diklat').active_link_method('create','diklat').active_link_method('update','diklat').active_link_method('detail_pegawai','diklat') ?>">
                    <a href="<?php echo base_url('diklat') ?>"><i class="fa fa-angle-double-right"></i> Diklat Pegawai</a>
                </li>
<!--                 <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Usulan Satya Lencana</a>
                </li> -->
              </ul>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('pengguna')); ?>">
              <a href="">
                  <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('index','pengguna').active_link_method('update_user','pengguna') ?>">
                    <a href="<?php echo base_url('pengguna') ?>"><i class="fa fa-angle-double-right"></i> Pengguna Sistem</a>
                </li>
                <li class="<?php echo active_link_method('update','pengguna') ?>">
                    <a href="<?php echo base_url('pengguna/update') ?>"><i class="fa fa-angle-double-right"></i> Pengaturan Akun</a>
                </li>
              </ul>
          </li>
      	</ul>
    </section>
</aside>
<div class="content-wrapper">
    <section class="content-header">
        <?php 
        /**
         * Generated Page Title
         *
         * @return string
         **/
         echo $this->page_title->show();

        /**
         * Generate Breadcrumbs from library
         *
         * @var string
         **/
          echo $this->breadcrumbs->show();
        ?>
    </section>
  <section class="content">
<?php
/* End of file left_sidebar.php */
/* Location: ./application/views/left_sidebar.php */