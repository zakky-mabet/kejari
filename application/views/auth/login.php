<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="theme-color" content="#E4E80D">
  <link rel="icon" sizes="192x192" href="<?php echo base_url('public/images/favicon.png') ?>" type="icon" />
  <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/components/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/components/Ionicons/css/ionicons.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/dist/css/style-login.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/plugins/iCheck/square/blue.css') ?>">
  <link rel="icon" href="<?php echo base_url('public/images/favicon.ico') ?>" type="image/x-icon" />
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
      .text-footer {  color:#EDEDEC }
      .text-orange {  color:#FF7700 }
  </style>
</head>
<body class="bg-color">
<div class="login-box ">
  <div class="login-logo text-center">
    <img width="200" src="<?php echo base_url('public/images/mainlogo.png') ?>" class="img-responsive" alt="Logo">
  </div>
  <div class="login-box-body" style="box-shadow:1px 2px 15px black">
    <?php echo form_open("auth/login");?>
      <div class="form-group">
        <?php if($message) : ?>
          <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback">
        <label>NIP :</label>
        <input type="text" class="form-control" name="identity" value="<?php echo set_value('identity') ?>" placeholder="NIP">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Password :</label>
        <input type="password" class="form-control" name="password" value="<?php echo set_value('password') ?>" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox icheck">
            <label>
             <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Tetap login
            </label>
          </div>
        </div>
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          <p style="padding-top: 20px" class="text-center"> <a href="<?php echo base_url() ?>" title="Back to Log in Options">Back to Log in Options</a></p>
        </div>
      </div>
    <?php echo form_close();?>
  </div>
</div>
<footer>
    <p class="text-center text-footer"><small>&copy; Hak Cipta <?php echo (date('Y')!=2018) ? date('2018 - Y') : date("Y");  ?> - KEJAKSAAN NEGERI <br> Kab. Bangka Barat, Kep. Bangka Belitung <br> Dibuat oleh <a href="http://www.teitramega.co.id" class="text-orange" target="_blank" title="Go to Web CV. Teitra Mega ">CV. Teitra Mega</a>, Pangkalpinang.</small></p>
</footer>
<script src="<?php echo base_url('public/components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('public/components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('public/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
    });
  });
</script>
</body>
</html>
