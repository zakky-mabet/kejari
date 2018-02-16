
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
          		<p><?php echo $user->first_name ?></p>
          		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        	</div>
      	</div>
      	<ul class="sidebar-menu" data-widget="tree">
        	<li class="<?php echo active_link_controller('welcome') ?>">
	          	<a href="<?php echo base_url('welcome') ?>">
	            	<i class="fa fa-dashboard"></i> <span>Dashboard</span>
	          	</a>
        	</li>
          <li class="<?php echo active_link_method('create') ?>">
              <a href="<?php echo base_url('laporan_masyarakat/create') ?>">
                <i class="fa fa-pencil"></i> <span>Buat Laporan Masyarakat</span>
              </a>
          </li>
          <li class="treeview <?php echo active_link_multiple(array('laporan_masyarakat')); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>INTELIJEN</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_controller('laporan_masyarakat') ?>">
                    <a href="<?php echo base_url('laporan_masyarakat') ?>"><i class="fa fa-angle-double-right"></i> Data Laporan Masyarakat</a>
                </li>
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Surat Perintah Penugasan</a>
                </li>
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Surat Perintah Operasi Intelijen</a>
                </li>
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Laporan Hasil Operasi Intelijen</a>
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
          <li class="treeview <?php echo active_link_multiple(array()); ?>">
              <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>PIDUM</span>
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
          <li class="treeview <?php echo active_link_multiple(array('kepegawaian','kepangkatan','diklat','gaji_berkala')); ?>">
              <a href="#">
                  <i class="fa fa-users"></i> <span>Kepegawaian</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_link_method('index','kepegawaian').active_link_method('update','kepegawaian').active_link_method('detail_kepangkatan','kepangkatan').active_link_method('create','kepangkatan').active_link_method('create_pangkat','kepangkatan').active_link_method('update','kepangkatan.')?>">
                    <a href="<?php echo base_url('kepegawaian') ?>"><i class="fa fa-angle-double-right"></i> Data Kepegawaian</a>
                </li>
                <li class="<?php echo active_link_method('create','kepegawaian') ?>">
                    <a href="<?php echo base_url('kepegawaian/create') ?>"><i class="fa fa-angle-double-right"></i> Tambah Pegawai</a>
                </li>
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Kenaikan Pangkat</a>
                </li>
                <li class="<?php echo active_link_method('index','gaji_berkala') ?>">
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
          <li class="treeview <?php echo active_link_multiple(array('users')); ?>">
              <a href="#">
                  <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Pengguna Sistem</a>
                </li>
                <li class="">
                    <a href=""><i class="fa fa-angle-double-right"></i> Pengaturan Akun</a>
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