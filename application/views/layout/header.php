<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo (isset($title)) ? $title : "Error! No Title"; ?></title>
    <link rel="icon" href="<?php echo base_url('public/images/favicon.png') ?>" type="icon" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/components/Ionicons/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/components/select2/dist/css/select2.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/dist/css/skins/skin-sipaten.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/dist/css/style-admin.css?v='.md5(date('YmdHis'))) ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/dist/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap-daterangepicker/daterangepicker.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/plugins/iCheck/all.css') ?>">
    <link rel="stylesheet" href=" <?php echo base_url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
    <style>
      .hoverTable{
            width:100%; 
            border-collapse:collapse; 
            }
      .hoverTable td
            { 
            padding:7px; border:#4e95f4 1px solid;
            }
      .hoverTable tr:hover
            {
            background-color: #D8E9A7;
            }
      tr:last-child {
        border: none !important;
      } 
</style> 
   <?php 
   /**
    * Load js from loader core
    *
    * @return CI_OUTPUT
    **/
   if($this->load->get_css_files() != FALSE) : 
      foreach($this->load->get_css_files() as $file) :  
    ?>
         <link rel="stylesheet" href="<?php echo $file; ?>?v=<?php echo md5(date('YmdHis')) ?>">
   <?php 
      endforeach; 
    endif; 
  ?>
    <script src="<?php echo base_url('public/dist/js/jquery-3.2.1.min.js') ?>"></script>
    <script src="<?php echo base_url('public/components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('public/components/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('public/components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?php echo base_url('public/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?php echo base_url('public/components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?php echo base_url('public/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?php echo base_url("public/plugins/bnotify/bootstrap-notify.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/components/select2/dist/js/select2.full.min.js"); ?>"></script>
    <script src="<?php echo base_url('public/dist/js/jquery.printPage.js') ?>"></script>
    <script src="<?php echo base_url('public/dist/js/jquery.sticky.min.js') ?>"></script>
    <script src="<?php echo base_url('public/dist/js/jquery.tableCheckbox.min.js') ?>"></script>
    <script src="<?php echo base_url('public/plugins/iCheck/icheck.min.js') ?>"></script>
    <script src="<?php echo base_url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
    <script src="http://kecamatansimpangkatis.com/tempayan/public/dist/js/jquery.sticky.min.js"></script>
    <script>
      var base_url = '<?php echo base_url() ?>',
          base_path = '<?php echo base_url('public') ?>';
     $(function () {
         //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })

      $('.textarea').wysihtml5(
        {toolbar: {
          'image' : false,
          'link' : false
        }}
        )

       $("#sticker").sticky({topSpacing:100});

     })
    </script>
   <?php 
   /**
    * Load js from loader core
    *
    * @return CI_OUTPUT
    **/
   if($this->load->get_js_files() != FALSE) : 
      foreach($this->load->get_js_files() as $file) :  
    ?>
         <script src="<?php echo $file; ?>?v=<?php echo md5(date('YmdHis')) ?>"></script>
   <?php 
      endforeach; 
    endif; 
  ?>
</head>
<body class="hold-transition skin-sipaten sidebar-mini fixed">
    <div class="wrapper">