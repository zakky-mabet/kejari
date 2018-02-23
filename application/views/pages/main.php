<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in Options</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('public/dist/css/style-login.css') ?>">
  <link rel="icon" href="<?php echo base_url('public/images/favicon.png') ?>" type="icon" />
  <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/components/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/dist/css/AdminLTE.min.css') ?> ">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css" media="screen"> 
    body { 
          background-image: url('<?php echo base_url('public/images/background.png') ?>'); 
          background-attachment: fixed; 
          background-repeat: no-repeat; 
          -webkit-background-size: cover; 
          -moz-background-size: cover; -o-background-size: cover; 
          background-size: cover; 
        } 
      .arial { font-family: arial; font-weight: normal; }
      .bg-color { background-color: #eaeaea; }
      .bg-color { background-color: #eaeaea`; }

      .merah-jambu {
        background-color: #FF1494;
      }
      .text-white { color: white }
      .bg-datun { background-color:  #AEC00A }
      .bg-bin { background-color: yellow }
      .text-footer { 
      color:#EDEDEC }
  </style>
</head>
<body class="bg-color">
<div class="login-box ">
  <div class="login-logo" style="margin-top: -30px;">
    <img width="200" src="<?php echo base_url('public/images/mainlogo.png') ?>" class="img-responsive" alt="Logo">
  </div>
  <div class="login-box-body" style="box-shadow:1px 2px 15px black">
    <div class=" text-right">
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social btn-default btn-flat"><i class="fa fa-user"></i> <b>KAJARI</b></a>
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social btn-success btn-flat"><i class="fa fa-circle-o"></i> <b>INTELIJEN</b></a>
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social text-white merah-jambu btn-flat"><i class="fa fa-circle-o"></i> <b>PIDSUS</b></a>
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social btn-danger btn-flat"><i class="fa fa-circle-o"></i> <b>PIDUM</b></a>
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social text-white bg-datun btn-flat"><i class="fa fa-circle-o"></i> <b>DATUN</b></a>
      <a style="padding-top: 10px; padding-bottom: 10px" href="<?php echo site_url('welcome') ?>" class="btn btn-block btn-social text-muted bg-bin btn-flat"><i class="fa fa-circle-o"></i> <b>BIN</b> </a>
    </div>
  </div>
  <footer style="margin-top: 20px">
    <p class="text-center text-footer"><small>&copy; Hak Cipta <?php echo (date('Y')!=2018) ? date('2018 - Y') : date("Y");  ?> - KEJAKSAAN NEGERI <br> Kab. Bangka Barat, Kep. Bangka Belitung <br> Dikembangkan oleh <a href="http://www.teitramega.co.id" class="text-orange" target="_blank" title="Go to Web CV. Teitra Mega">CV. Teitra Mega</a>, Pangkalpinang.</small></p>
  </footer>
</div>

</body>
</html>



